<?php

	Class migration_260 extends Migration {

		static function getVersion(){
			return '2.6.0-alpha.1';
		}

		static function getReleaseNotes(){
			return 'http://getsymphony.com/download/releases/version/2.6.0/';
		}

		static function upgrade() {
			// Add date field options
			try {
				Symphony::Database()->query('
					ALTER TABLE `tbl_fields_date`
					ADD `calendar` enum("yes","no") COLLATE utf8_unicode_ci NOT NULL DEFAULT "no",
					ADD `time` enum("yes","no") COLLATE utf8_unicode_ci NOT NULL DEFAULT "yes";
				');
			}
			catch (Exception $ex) {}

			// Add namespace field to the cache table. RE: #2162
			try {
				Symphony::Database()->query('
					ALTER TABLE `tbl_cache` ADD `namespace` VARCHAR(255) COLLATE utf8_unicode_ci;
				');
			}
			catch (Exception $ex) {}

			// Update the version information
			return parent::upgrade();
		}
	}
