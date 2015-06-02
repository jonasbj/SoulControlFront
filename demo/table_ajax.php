<?php
  /* 
   * Paging
   */

  $iTotalRecords = 178;
  $iDisplayLength = intval($_REQUEST['length']);
  $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
  $iDisplayStart = intval($_REQUEST['start']);
  $sEcho = intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 

  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

  $status_list = array(
    array("success" => "Confirmed"),
    array("info" => "Plan"),
    array("danger" => "Canceled"),
    array("warning" => "Offer")
  );

  for($i = $iDisplayStart; $i < $end; $i++) {
    $status = $status_list[rand(0, 3)];
    $id = ($i + 1);
    $records["data"][] = array(
      '<input type="checkbox" name="id[]" value="'.$id.'">',
      '2015 - august 12th',
      'Jonas Barsten',
      'Oslo',
      'Parkteateret',
      "10'000 NOK",
      rand(1, 100),
      '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
      '<a href="javascript:;" class="btn btn-xs default"><i class="fa fa-search"></i> View</a>',
   );
  }

  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }

  $records["draw"] = $sEcho;
  $records["recordsTotal"] = $iTotalRecords;
  $records["recordsFiltered"] = $iTotalRecords;
  
  echo json_encode($records);
?>