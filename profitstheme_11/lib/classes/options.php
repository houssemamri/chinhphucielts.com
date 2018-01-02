<?php

class PtOptions extends PtFields {

	function setTabs( $tabsid, $tabsnames )
	{
		$this->_tabsHeader  = '<div id="' . $tabsid . '" class="indentmenu">' . "\n";
		$this->_tabsHeader .= "\t" . '<ul>' . "\n";
		
		$counter = 0;
		foreach ( $tabsnames as $tabname => $tabtitle ) {
			$counter++;
			$selected = $counter == 1 ? ' class="selected"' : '';
			$this->_tabsHeader .= "\t\t" . '<li><a href="#" rel="' . $tabname . '"' . $selected . '>' . $tabtitle . '</a></li>' . "\n";
		}

		$this->_tabsHeader .= "\t" . '</ul>' . "\n";
		$this->_tabsHeader .= "\t" . '<br style="clear: left" />' . "\n";
		$this->_tabsHeader .= '</div>' . "\n\n";
	}

	function getTabsHeader()
	{
		return $this->_tabsHeader;
	}

	function setTabsScript( $tabsid )
	{
		$this->_tabsScript  = '<script type="text/javascript">' . "\n";
		$this->_tabsScript .= "\t" . 'var gpf = new ddtabcontent("' . $tabsid . '")' . "\n";
		$this->_tabsScript .= "\t" . 'gpf.setpersist(true)' . "\n";
		$this->_tabsScript .= "\t" . 'gpf.setselectedClassTarget("link")' . "\n";
		$this->_tabsScript .= "\t" . 'gpf.init()' . "\n";
		$this->_tabsScript .= '</script>' . "\n\n";
	}

	function getTabsScript()
	{
		return $this->_tabsScript;
	}

	function setTabsContentOpen( $id )
	{
		$this->_tabsContentOpen = "\t" . '<div id="' . $id . '">' . "\n";
	}

	function getTabsContentOpen()
	{
		return $this->_tabsContentOpen;
	}

	function setOptions( $options, $tabsid, $tabsnames, $formId, $notabs = false )
	{

		$this->setTabs( $tabsid, $tabsnames );

		if ( pt_isset($_GET['page']) == 'pt_update_options' ) {
			$showform = false;
		} else if ( pt_isset($_GET['page']) == 'pt_settings_options' ) {
			$showform = false;
		} else {
			$showform = true;
		}

		if ( $showform == true ) {
			$this->_optionsDisplay  = "\n\n" .'<form method="post" name="' . $formId . '" id="' . $formId . '" enctype="multipart/form-data">' . "\n\n";
		}

		if ( $notabs == false ) {
			$this->_optionsDisplay .= $this->getTabsHeader();
		}

		$this->_optionsDisplay .= '<div class="admin-field">' . "\n";

	
		if ( pt_isset($_GET['page']) == 'pt_site_options' ) {
			$pt_site_options = maybe_unserialize(get_option('pt_site_options'));
			foreach ( $pt_site_options as $pt_site_option ) {
				$$pt_site_option['id'] = $pt_site_option['value'];
			}
		} else if ( pt_isset($_GET['page']) == 'pt_design_options' ) {
			$pt_design_options = maybe_unserialize(get_option('pt_design_options'));
			foreach ( $pt_design_options as $pt_design_option ) {
				$$pt_design_option['id'] = $pt_design_option['value'];
			}
		} else if ( pt_isset($_GET['page']) == 'pt_launch_options' ) {
			$pt_launch_options = maybe_unserialize(get_option('pt_launch_options'));
			foreach ( $pt_launch_options as $pt_launch_option ) {
				$$pt_launch_option['id'] = $pt_launch_option['value'];
			}
		}  else if ( pt_isset($_GET['page']) == 'pt_page_generator' ) {
			$pt_page_generator = maybe_unserialize(get_option('pt_generator_options'));
			foreach ( $pt_page_generator as $pt_page) {
				$$pt_page['id'] = $pt_page['value'];
			}
		}  else if ( pt_isset($_GET['page']) == 'pt_integrate_options' ) {
			$pt_integrate_options = maybe_unserialize(get_option('pt_integrate_options'));
			foreach ( $pt_integrate_options as $pt_page) {
				$$pt_page['id'] = $pt_page['value'];
			}
		}
	
		foreach ( $options as $value ) {
			
			if (!pt_isset($value)) continue;
			
			switch ( $value['type'] ) {
				case 'divwrapopen':
				
				$this->_optionsDisplay .= "\t\t" . '<div id="' . $value['id'] . '">' . "\n";
				break;

				case 'divwrapclose':
				
				$this->_optionsDisplay .= "\t\t" . '</div>' . "\n";
				break;

				case 'biglabel':
				
				$this->_optionsDisplay .= "\t\t" . '<div class="biglabel">' . $value['name']. '</div>' . "\n";
				break;
				
				case 'tabopen':
				
				$this->setTabsContentOpen( $value['id'] );
				$this->_optionsDisplay .= $this->getTabsContentOpen();
				break;

				case 'tabclose':

				$this->_optionsDisplay .= "\t" . '</div>' . "\n\n";
				break;

				case 'blockopen':
				
				$this->_optionsDisplay .= "\t\t" . '<div class="block">' . "\n";
				break;

				case 'blockclose':
				
				$this->_optionsDisplay .= "\t\t" . '</div>' . "\n\n";
				break;

				case 'hidden':

				$this->setValue( $value['std'], pt_isset($$value['id']) );
				$this->_optionsDisplay .= "\t\t" . '<input name="' . $value['id'] . '" id="' . $value['id'] . '"  type="hidden" value="' . $this->getValue() . '" />' . "\n";
				break;

				case 'submit':

				$this->_optionsDisplay .= "\t\t" . '<p class="submit">' . "\n";
				$this->_optionsDisplay .= "\t\t\t" . '<input name="save" type="submit" value="' . $value['name'] . '" />' . "\n";
				$this->_optionsDisplay .= "\t\t" . '</p>' . "\n\n";
				break;

				case 'formopen':

				$confirm = isset($value['msg']) ? ' onsubmit="return confirm(\'' . $value['msg'] . '\')"' : '';
				$this->_optionsDisplay .= "\t\t" . '<form method="post" name="' . $value['id'] . '" id="' . $value['id'] . '" enctype="multipart/form-data"' . $confirm . '>' . "\n";
				break;

				case 'formclose':

				$this->_optionsDisplay .= "\t\t" . '</form>' . "\n";
				break;

				case 'fieldtitle':

				$this->_optionsDisplay .= "\t\t" . '<div class="fieldsection">' . "\n";
				$this->_optionsDisplay .= "\t\t\t" . '<div class="fieldtitle">' . $value['name'] . '</div>' . "\n";
				$this->_optionsDisplay .= "\t\t" . '</div>' . "\n\n";

				break;
				
				case 'generatortitle':

				$this->_optionsDisplay .= "\t\t" . '<div class="fieldsection">' . "\n";
				$this->_optionsDisplay .= "\t\t\t" . '<div class="fieldtitle generatortitle">' . $value['name'] . '</div>' . "\n";
				$this->_optionsDisplay .= "\t\t" . '</div>' . "\n\n";

				break;

				case 'note':
				
				$this->setNoteField( $value['name'], $value['desc'] );
				$this->_optionsDisplay .= $this->getNoteField();
				break;

				case 'skinsmanager':
				
				$this->setSkinsManagerField( $value, pt_isset($$value['id']), $formId );
				$this->_optionsDisplay .= $this->getSkinsManagerField();

				break;

				case 'layout':
				
				$this->setLayoutField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getLayoutField();
				break;

				case 'background':
				
				$this->setBackgroundField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getBackgroundField();
				break;

				case 'header':
				
				$this->setHeaderBgField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getHeaderBgField();

				break;

				case 'typo':
				
				$this->setTypographyField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getTypographyField();
				break;

				case 'text':

				$this->setValue( $value['std'], pt_isset($$value['id']) );
      				$this->setTextField( $value, $this->getValue() );
				$this->_optionsDisplay .= $this->getTextField();
				break;

				case 'ppfunnel':

      				$this->setPPFunnelField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getPPFunnelField();
				break;
	
				case 'showproducts':

      				$this->setProductTableField( $value );
				$this->_optionsDisplay .= $this->getProductTableField();
				break;

				case 'productform':

      				$this->setProductFormField( $value );
				$this->_optionsDisplay .= $this->getProductFormField();
				break;

				case 'protectlevel':
				
				$this->setProtectLevelField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getProtectLevelField();
				break;

				case 'protectpages':
				
				$this->setProtectPagesField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getProtectPagesField();
				break;

				case 'folder':

				$this->setValue( $value['std'], pt_isset($$value['id']) );
      				$this->setTextField( $value, $this->getValue() );
				$this->_optionsDisplay .= $this->getTextField();
				break;

				case 'doubletext':

      				$this->setDoubleTextField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getDoubleTextField();
				break;

				case 'select':
				
				$this->setSelectField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getSelectField();
				break;

				case 'multiselect':
				
				$this->setMultiSelectField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getMultiSelectField();
				break;

				case 'addlaunchpages':
				
				$this->setLaunchPagesField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getLaunchPagesField();
				break;

				case 'checkbox':
				
				$this->setCheckboxField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getCheckboxField();
				break;

				case 'textarea':
				
				$this->setValue( $value['std'], pt_isset($$value['id']) );
				$this->setTextareaField( $value, $this->getValue() );
				$this->_optionsDisplay .= $this->getTextareaField();
				break;

				case 'color':
				
				$this->setValue( $value['std'], pt_isset($$value['id']) );
				$this->setColorField( $value, $this->getValue() );
				$this->_optionsDisplay .= $this->getColorField();
				break;

				case 'upload':
				
				$this->setValue( $value['std'], pt_isset($$value['id']) );
				$this->setUploadField( $value, $this->getValue() );
				$this->_optionsDisplay .= $this->getUploadField();
				break;

				case 'instantpage':
				
				$this->setCheckboxField( $value, pt_isset($$value['id']) );
				$this->_optionsDisplay .= $this->getCheckboxField();
				break;

				case 'import':
				
				$this->setImportField( $value );
				$this->_optionsDisplay .= $this->getImportField();
				break;

				case 'updatefield':
				
				$this->setUpdateField( $value );
				$this->_optionsDisplay .= $this->getUpdateField();
				break;

			}

			unset($value);
		}

		$this->_optionsDisplay .= '</div>' . "\n\n";

		if ( $notabs == false ) {
			$this->setTabsScript( $tabsid );
			$this->_optionsDisplay .= $this->getTabsScript();
		}

		if ( $showform == true ) {
			$this->_optionsDisplay .= '</form>' . "\n\n";
		}
	}

	function getOptions()
	{
		return $this->_optionsDisplay;
	}
}