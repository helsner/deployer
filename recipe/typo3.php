<?php
namespace Deployer;

require_once __DIR__ . '/common.php';

/**
 * DocumentRoot / WebRoot for the TYPO3 installation
 */
set('typo3_webroot', 'Web');

/**
 * Main TYPO3 task
 */
task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'deploy:publish',
])->desc('Deploy your project');
after('deploy', 'success');

/**
 * Shared directories
 */
set('shared_dirs', [
    '{{typo3_webroot}}/fileadmin',
    '{{typo3_webroot}}/typo3temp',
    '{{typo3_webroot}}/uploads'
]);

/**
 * Shared files
 */
set('shared_files', [
    '{{typo3_webroot}}/.htaccess'
]);

/**
 * Writeable directories
 */
set('writable_dirs', [
    '{{typo3_webroot}}/fileadmin',
    '{{typo3_webroot}}/typo3temp',
    '{{typo3_webroot}}/typo3conf',
    '{{typo3_webroot}}/uploads'
]);
