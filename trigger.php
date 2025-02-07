<?php
$data = \RestUtility::processRequest(true);
$post = $data->getRequestVars();

$dq = new DataQuality();

$rule_info = $dq->getRule($post['rule_id'], NULL);
// hack to make it fix calculations
// see Classes/DataQuality.php:1207 (in RC v13.1.25)
$_POST['action'] = 'fixCalcs';

$dq->executeRule($post['rule_id']);