<?php
/**
 * Sources English lexicon topic
 *
 * @language en
 * @package modx
 * @subpackage lexicon
 */
$_lang['access'] = 'Access Permissions';
$_lang['base_path'] = 'Base Path';
$_lang['base_path_relative'] = 'Base Path Relative?';
$_lang['base_url'] = 'Base URL';
$_lang['base_url_relative'] = 'Base URL Relative?';
$_lang['minimum_role'] = 'Minimum Role';
$_lang['path_options'] = 'Path Options';
$_lang['policy'] = 'Policy';
$_lang['source'] = 'Media Source';
$_lang['source_access_add'] = 'Add User Group';
$_lang['source_access_remove'] = 'Remove Access';
$_lang['source_access_remove_confirm'] = 'Are you sure you want to remove Access to this Source for this User Group?';
$_lang['source_access_update'] = 'Update Access';
$_lang['source_create'] = 'Create New Media Source';
$_lang['source_properties.intro_msg'] = 'Manage the properties for this Source below.';
$_lang['source_remove'] = 'Remove Media Source';
$_lang['source_remove_confirm'] = 'Are you sure you want to remove this Media Source? This might break any TVs you have assigned to this source.';
$_lang['source_remove_multiple'] = 'Remove Multiple Media Sources';
$_lang['source_remove_multiple_confirm'] = 'Are you sure you want to remove these Media Sources? This might break any TVs you have assigned to these sources.';
$_lang['source_update'] = 'Update Media Source';
$_lang['source_type'] = 'Source Type';
$_lang['source_type.file'] = 'File System';
$_lang['source_type.file_desc'] = 'A filesystem-based source that navigates your server\'s files.';
$_lang['source_type.s3'] = 'Amazon S3';
$_lang['source_type.s3_desc'] = 'Navigates an Amazon S3 bucket.';
$_lang['source_types'] = 'Source Types';
$_lang['source_types.intro_msg'] = 'This is a list of all the installed Media Source Types you have on this MODX instance.';
$_lang['source.access.intro_msg'] = 'Here you can restrict a Media Source to specific User Groups and apply policies for those User Groups. A Media Source with no User Groups attached to it is available to all manager users.';
$_lang['sources'] = 'Media Sources';
$_lang['sources.intro_msg'] = 'Manage all your Media Sources here.';
$_lang['user_group'] = 'User Group';

/* file source type */
$_lang['prop_file.allowedFileTypes_desc'] = 'If set, will restrict the files shown to only the specified extensions. Please specify in a comma-separated list, without the .';
$_lang['prop_file.basePath_desc'] = 'The file path to point the Image TV to. If not set, will use the filemanager_path setting, or the base MODX path. May use [[++base_path]], [[++core_path]] and [[++assets_path]] placeholders inside this value.';
$_lang['prop_file.basePathRelative_desc'] = 'If the Base Path setting above is not relative to the MODX install path, set this to Yes.';
$_lang['prop_file.baseUrl_desc'] = 'The file URL to point the Image TV to. If not set, will use the filemanager_url setting, or the base MODX URL. May use [[++base_url]], [[++core_url]] and [[++assets_url]] placeholders inside this value.';
$_lang['prop_file.baseUrlPrependCheckSlash_desc'] = 'If true, MODX only will prepend the baseUrl if no forward slash (/) is found at the beginning of the URL when rendering the TV. Useful for setting a TV value outside the baseUrl.';
$_lang['prop_file.baseUrlRelative_desc'] = 'If the Base URL setting above is not relative to the MODX install URL, set this to Yes.';
$_lang['prop_file.imageExtensions_desc'] = 'A comma-separated list of file extensions to use as images. MODX will attempt to make thumbnails of files with these extensions.';
$_lang['prop_file.skipFiles_desc'] = 'A comma-separated list. MODX will skip over and hide files and folders that match any of these.';
$_lang['prop_file.thumbnailQuality_desc'] = 'The quality of the rendered thumbnails, in a scale from 0-100.';
$_lang['prop_file.thumbnailType_desc'] = 'The image type to render thumbnails as.';

/* s3 source type */
$_lang['bucket'] = 'Bucket';
$_lang['prop_s3.bucket_desc'] = 'The S3 Bucket to load your data from.';
$_lang['prop_s3.key_desc'] = 'The Amazon key for authentication to the bucket.';
$_lang['prop_s3.imageExtensions_desc'] = 'A comma-separated list of file extensions to use as images. MODX will attempt to make thumbnails of files with these extensions.';
$_lang['prop_s3.secret_key_desc'] = 'The Amazon secret key for authentication to the bucket.';
$_lang['prop_s3.skipFiles_desc'] = 'A comma-separated list. MODX will skip over and hide files and folders that match any of these.';
$_lang['prop_s3.thumbnailQuality_desc'] = 'The quality of the rendered thumbnails, in a scale from 0-100.';
$_lang['prop_s3.thumbnailType_desc'] = 'The image type to render thumbnails as.';
$_lang['prop_s3.url_desc'] = 'The URL of the Amazon S3 instance.';
