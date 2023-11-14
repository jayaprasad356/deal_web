<?php require_once('mod_rewrite.php'); ?>

<?php


$requestedPage = basename($_SERVER["SCRIPT_FILENAME"], '.php');

if($requestedPage === "index") {
    
    $stateCC = filterInput($_GET['state']);
    $districtCC = filterInput($_GET['district']);
    $blockCC = filterInput($_GET['block']);
    $officeCC = filterInput($_GET['office']);
	$state = filterInput($_GET['state']);

    
    if(!empty($officeCC)) {
        
       // -- fetch office query
		$dbQuery = "SELECT * FROM `pin_details` WHERE `pin_state` = '".$stateCC."' AND `pin_office` = '".$officeCC."' LIMIT 1";
        
    } else if(!empty($blockCC)) {
                
         // -- fetch blocks query
        $dbQuery = "SELECT DISTINCT `pin_state`,`pin_district`,`pin_type`,`pin_office` FROM `pin_details` WHERE `pin_state` = '".$stateCC."' AND `pin_district` = '".$districtCC."' AND `pin_type` = '".$blockCC."' ORDER BY `pin_office` ASC";

        
    } else if(!empty($districtCC)) {
		
		         // -- fetch blocks query
        $dbQuery = "SELECT DISTINCT `pin_state`,`pin_district`,`pin_type` FROM `pin_details` WHERE `pin_state` = '".$stateCC."' AND `pin_district` = '".$districtCC."' ORDER BY `pin_type` ASC";
		
    } else if(!empty($stateCC)) {
		
		// -- fetch districts query
        $dbQuery = "SELECT DISTINCT `pin_state`,`pin_district` FROM `state_details` WHERE `pin_state` = '".$stateCC."' ORDER BY `pin_district` ASC";

    } else {
        
        // home page title, page description and page keywords
		
		$districtment = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
		$districtment->execute();
		$result = $districtment->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{

        $pageTitle = $row['meta_title_pin'];
        $pageDescription = $row['meta_description_pin'];
        $pageKeywords = $row['meta_keyword_pin'];
        }
		
		$hTitle = $row['home_pin_title'];
        $pDescription = $row['home_pin_description'];
		$pContent = $row['home_pin_content'];
        // -- fetch states query
        $dbQuery = "SELECT DISTINCT `pin_state` FROM `state_details` ORDER BY `pin_state` ASC";
		
    }
    
    $dbQueryResult = mysqli_query($dbconn, $dbQuery);
    $totalResultsCount = intval(mysqli_num_rows($dbQueryResult));
    $results = array();
    
    if($totalResultsCount > 0) {
       while($singleResult = mysqli_fetch_array($dbQueryResult, MYSQLI_ASSOC)) {
            $results[] = $singleResult;
        }
    } else {
       header("HTTP/1.0 404 Not Found");
	   header('Location: /');
       die;
	} 
 if(!empty($officeCC)) {
        
		
        $pinCC = ($results[0]['pin_code']);
        $string = $pin_title_office;
		$find = array('[state]', '[district]', '[block]', '[office]', '[stateshort]', '[pincode]');
		$replace = array("$stateCC", "$districtCC", "$blockCC", "$officeCC", "$state_short", "$pinCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $pin_description_office;
		$find = array('[state]', '[district]', '[block]', '[office]', '[stateshort]', '[pincode]');
		$replace = array("$stateCC", "$districtCC", "$blockCC", "$officeCC", "$state_short", "$pinCC");
		$pageDescription = str_replace($find, $replace, $string);
        
        $pageKeywords = $stateCC . " " . $districtCC . "" . $officeCC . " pin Code, " . $stateCC . " " . $officeCC . " pin Code, " . $stateCC . " " . $officeCC . "" . $blockCC . " pin Code details,";
		
		$string = $pin_heading_office;
		$find = array('[state]', '[district]', '[block]', '[office]', '[stateshort]', '[pincode]');
		$replace = array("$stateCC", "$districtCC", "$blockCC", "$officeCC", "$state_short", "$pinCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $pin_paragraph_office;
		$find = array('[state]', '[district]', '[block]', '[office]', '[stateshort]', '[pincode]');
		$replace = array("$stateCC", "$districtCC", "$blockCC", "$officeCC", "$state_short", "$pinCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$string = $pin_keywords_office;
		$find = array('[state]', '[district]', '[block]', '[office]', '[stateshort]', '[pincode]');
		$replace = array("$stateCC", "$districtCC", "$blockCC", "$officeCC", "$state_short", "$pinCC");
		$officekeywords = str_replace($find, $replace, $string);
		
		$og_photo = $pin_photo;
        	
        
    } else if(!empty($blockCC)) {
                
		$string = $pin_title_block;
		$find = array('[state]', '[district]', '[block]');
		$replace = array("$stateCC", "$districtCC", "$blockCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $pin_description_block;
		$find = array('[state]', '[district]', '[block]');
		$replace = array("$stateCC", "$districtCC", "$blockCC");
		$pageDescription = str_replace($find, $replace, $string);
        
        $pageKeywords = $stateCC . " " . $districtCC . " " . $blockCC . " pin Code, " . $blockCC . " pin Code " . $blockCC . " " . $districtCC . " All Branches list,";
		
		$string = $pin_heading_block;
		$find = array('[state]', '[district]', '[block]');
		$replace = array("$stateCC", "$districtCC", "$blockCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $pin_paragraph_block;
		$find = array('[state]', '[district]', '[block]');
		$replace = array("$stateCC", "$districtCC", "$blockCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $pin_photo;

        
    } else if(!empty($districtCC)) {
        
        $string = $pin_title_district;
		$find = array('[state]', '[district]');
		$replace = array("$stateCC", "$districtCC");
		$pageTitle = str_replace($find, $replace, $string);
        
		$string = $pin_description_district;
		$find = array('[state]', '[district]');
		$replace = array("$stateCC", "$districtCC");
		$pageDescription = str_replace($find, $replace, $string);
		
        $pageKeywords = $stateCC . " " . $districtCC . " pin Code, " . $districtCC . " " . $stateCC . " pin Code list,";
		
		$string = $pin_heading_district;
		$find = array('[state]', '[district]');
		$replace = array("$stateCC", "$districtCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $pin_paragraph_district;
		$find = array('[state]', '[district]');
		$replace = array("$stateCC", "$districtCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $pin_photo;
        
        
    } else if(!empty($stateCC)) {
		
		$string = $pin_title_state;
		$find = array('[state]');
		$replace = array("$stateCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $pin_description_state;
		$find = array('[state]');
		$replace = array("$stateCC");
		$pageDescription = str_replace($find, $replace, $string);
		
        $pageKeywords = $stateCC . " pin Code List, ". $stateCC . " states pin Code,";
		
		$string = $pin_heading_state;
		$find = array('[state]');
		$replace = array("$stateCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $pin_paragraph_state;
		$find = array('[state]');
		$replace = array("$stateCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $pin_photo;
        
		

    }	
    }
?>
<?php require 'header.php'; ?>