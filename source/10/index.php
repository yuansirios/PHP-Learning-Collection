<?php
require '../tool/log.class.php';
MyLog::setLog("content1");
MyLog::setLog("content2","");
MyLog::setLog("content3","","error");
MyLog::setLog("content4","","5");
MyLog::setLog("content5","","400");
MyLog::setLog("content6","","400","yxd","json");
MyLog::setLog("content7","","400","yxd","line");
MyLog::setLog(["content8"],"","400","yxd","line");
MyLog::setLog(["content8"],"","400","yxd","line","/tmp/jq.log");
MyLog::setLog(["content8"],"","400","yxd","line","/tmp/jq.log");