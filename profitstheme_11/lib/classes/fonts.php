<?php

class PtFonts {

	protected $fonts = array();
	protected $cufon = array();
	protected $google = array();
	protected $allfonts = array();

	function __construct()
	{
		$this->fonts = array(
			'arial' => array(
				'name' => 'Arial',
				'family' => 'Arial, "Helvetica Neue", Helvetica, sans-serif',
				'websafe' => true
			),

			'arial_black' => array(
				'name' => 'Arial Black',
				'family' => '"Arial Black", "Arial Bold", Arial, sans-serif',
				'websafe' => true
			),

			'arial_narrow' => array(
				'name' => 'Arial Narrow',
				'family' => '"Arial Narrow", Arial, "Helvetica Neue", Helvetica, sans-serif',
				'websafe' => true
			),
 
			'calibri' => array(
				'name' => 'Calibri',
				'family' => 'Calibri, Candara, Segoe, Optima, sans-serif',
				'websafe' => false
			),

			'courier_new' => array(
				'name' => 'Courier New',
				'family' => '"Courier New", Courier, Verdana, sans-serif',
				'websafe' => true
			),

			'georgia' => array(
				'name' => 'Georgia',
				'family' => 'Georgia, "Times New Roman", Times, serif',
				'websafe' => true
			),
		
			'geneva' => array(
				'name' => 'Geneva',
				'family' => 'Geneva, Tahoma, Verdana, sans-serif',
				'websafe' => false
			),

			'helvetica' => array(
				'name' => 'Helvetica',
				'family' => '"Helvetica Neue", Helvetica, sans-serif',
				'websafe' => false
			),

			'impact' => array(
				'name' => 'Impact',
				'family' => 'Impact, Charcoal, sans-serif',
				'websafe' => true
			),

			'lucida' => array(
				'name' => 'Lucida',
				'family' => '"Lucida Grande", "Lucida Sans Unicode", sans-serif',
				'websafe' => true
			),

			'palatino' => array(
				'name' => 'Palatino',
				'family' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'websafe' => true
			),

			'tahoma' => array(
				'name' => 'Tahoma',
				'family' => 'Tahoma, Geneva, sans-serif',
				'websafe' => true
			),

			'times_new_roman' => array(
				'name' => 'Times New Roman',
				'family' => '"Times New Roman", Times, Georgia, serif',
				'websafe' => true
			),

			'trebuchet_ms' => array(
				'name' => 'Trebuchet MS',
				'family' => '"Trebuchet MS", "Lucida Grande", "Lucida Sans", Arial, sans-serif',
				'websafe' => true
			),

			'verdana' => array(
				'name' => 'Verdana',
				'family' => 'Verdana, sans-serif',
				'websafe' => true
			)
		);

		$this->cufon = array(
			'bebasneue' => array(
				'name' => 'Bebas Neue',
				'family' => 'Bebas Neue',
				'cufon' => true,
			),

			'chunkfive' => array(
				'name' => 'ChunkFive',
				'family' => 'ChunkFive',
				'cufon' => true,
			),

			'delicious' => array(
				'name' => 'Delicious',
				'family' => 'Delicious',
				'cufon' => true,
			),

			'handofsean' => array(
				'name' => 'Hand Of Sean',
				'family' => 'Hand Of Sean',
				'cufon' => true,
			),

			'impact2' => array(
				'name' => 'Impact',
				'family' => 'Impact',
				'cufon' => true,
			),
			
			'leaguegothic' => array(
				'name' => 'League Gothic',
				'family' => 'League Gothic',
				'cufon' => true,
			),
 
			'mgopenmoderna' => array(
				'name' => 'MgOpen Moderna',
				'family' => 'MgOpen Moderna',
				'cufon' => true,
			),

			'sansation' => array(
				'name' => 'Sansation',
				'family' => 'Sansation',
				'cufon' => true,
			),

			'sueellenfrancisco' => array(
				'name' => 'Sue Ellen Francisco',
				'family' => 'Sue Ellen Francisco',
				'cufon' => true,
			),
			
		);
		
		// google fonts //
		$this->google = array(
			'opensans' => array(
				'name' => 'Open Sans',
				'family' => 'Open Sans',
				'google' => true,
			),
			
			'roboto' => array(
				'name' => 'Roboto',
				'family' => 'Roboto',
				'google' => true,
			),
			
			'ubuntu' => array(
				'name' => 'Ubuntu',
				'family' => 'Ubuntu',
				'google' => true,
			),
			
			'ubuntucondensed' => array(
				'name' => 'Ubuntu Condensed',
				'family' => 'Ubuntu Condensed',
				'google' => true,
			),
			
			'exo' => array(
				'name' => 'Exo',
				'family' => 'Exo',
				'google' => true,
			),
			
			'handle' => array(
				'name' => 'Handlee',
				'family' => 'Handlee',
				'google' => true,
			),
		);
	}

	public function getFonts()
	{
		$default = array_merge( $this->fonts, $this->google );
		asort($default);
		
		return $default;
	}

	public function getCufon()
	{
		return $this->cufon;
	}
	
	public function getGoogle()
	{
		return $this->google;
	}

	public function getAllFonts()
	{
		$default = array_merge( $this->fonts, $this->cufon, $this->google );
		asort($default);
		
		return $default;
	}
	
}
