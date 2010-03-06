<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['rootsearch'] = '{title_legend},name,headline,type;{config_legend},queryType,perPage,contextLength,totalLength,searchRoots;{template_legend:hide},searchType,searchTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['searchRoots'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['searchRoots'],
	'inputType'			=> 'checkbox',
	'options_callback'	=> array('tl_module_rootsearch', 'getRootPages'),
	'eval'				=> array('multiple'=>true, 'tl_class'=>'clr'),
);


class tl_module_rootsearch extends Backend
{
	
	public function getRootPages($dc)
	{
		$arrPages = array();
		
		$objPages = $this->Database->execute("SELECT * FROM tl_page WHERE type='root'");
		
		while( $objPages->next() )
		{
			$arrPages[$objPages->id] = $objPages->title . (strlen($objPages->dns) ? (' (' . $objPages->dns . ')') : '');
		}
		
		return $arrPages;
	}
}

