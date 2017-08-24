<?php
if ($tid==$tid_feedback){
	require_once("../".$templatesfile."list_feedback.html");		
}else{
	$pageinfo->GetPageInfo($tmpid,$pagesize,$arrparam,$tmpsql);
}
?>