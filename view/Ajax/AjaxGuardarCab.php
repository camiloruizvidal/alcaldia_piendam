<?php

include_once '../../model/modelConfig.php';
$co = new modelConfig();
$co->EditValue('formato_admin', $_POST['value']);
