<?php

	class extension_markitup_editor extends Extension {
		private $params = array();

		public function about() {
			return array(
				'name'			=> 'markItUp Editor',
				'version'		=> '1.0',
				'release-date'	=> '2011-03-14',
				'author'		=> array(
					'name'			=> 'Nick Ryall',
					'website'		=> 'http://randb.com.au/',
					'email'			=> 'nick@randb.com.au'
				),
				'description'	=> 'Applies the markItUp WYSIWYG editor to textareas'
	 		);
		}
		
	/*-------------------------------------------------------------------------
		Installation:
	-------------------------------------------------------------------------*/		
		

		public function uninstall() {
			$this->_Parent->Configuration->remove('markitup');
			$this->_Parent->saveConfig();
		}

		public function getSubscribedDelegates() {
			return array(
				array(
					'page' => '/backend/',
					'delegate' => 'InitaliseAdminPageHead',
					'callback' => 'appendAssets'
				),

				array(
					'page'		=> '/system/preferences/',
					'delegate'	=> 'AddCustomPreferenceFieldsets',
					'callback'	=> 'appendPreferences'
				)
			);
		}

		
		public function getFormatter() {
			return $this->_Parent->Configuration->get('textformatter', 'markitup');
		}

		public function appendPreferences($context) {
			$group = new XMLElement('fieldset');
			$group->setAttribute('class', 'settings');
			$group->appendChild(
				new XMLElement('legend', 'markItUp Editor')
			);
			
			$options = array(
				array('Markdown',  General::Sanitize($this->getFormatter()) == 'Markdown'),
				array('Textile',  General::Sanitize($this->getFormatter()) == 'Textile')
			);

			$formatter = Widget::Label('Text Formatter');
			$formatter->appendChild(Widget::select(
				'settings[markitup][textformatter]', $options
				
			));
			$group->appendChild($formatter);

			$context['wrapper']->appendChild($group);
		}
	
		
	/*-------------------------------------------------------------------------
		Utitilites:
	-------------------------------------------------------------------------*/
		
		public function appendAssets($context) {
			
			$page = $context['parent']->Page;
			$textformatter = extension_markitup_editor::getFormatter();

			$page->addStylesheetToHead(URL . '/extensions/markitup_editor/assets/skin/markitup.skins.style.css', 'screen', 10000, true);
			$page->addStylesheetToHead(URL . '/extensions/markitup_editor/assets/sets/'.$textformatter.'/markitup.set.style.css', 'screen', 10001, true);
			
			$page->addScriptToHead(URL . '/extensions/markitup_editor/assets/jquery.markitup.js', 10002, false);
			$page->addScriptToHead(URL . '/extensions/markitup_editor/assets/sets/'.$textformatter.'/markitup.set.js', 10003, false);
			
			$page->addScriptToHead(URL . '/extensions/markitup_editor/assets/markitup_editor.publish.js', 10004, false);

		}



	}

?>