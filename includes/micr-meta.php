<?php require_once('mod_rewrite.php'); ?>

<?php

$requestedPage = basename($_SERVER["SCRIPT_FILENAME"], '.php');

if($requestedPage === "index") {
    
    $bankCC = filterInput($_GET['bank']);
    $stateCC = filterInput($_GET['state']);
    $districtCC = filterInput($_GET['district']);
    $branchCC = filterInput($_GET['branch']);
    
    if(!empty($branchCC)) {
        
        // page title, page description and page keywords when bank, state, district and branch selected
		$dbQuery = "SELECT * FROM `bank_details` WHERE `bank_name` = '".$bankCC."' AND `bank_branch` = '".$branchCC."' LIMIT 1";
        
    } else if(!empty($districtCC)) {
		
		 // -- fetch districts query
        $dbQuery = "SELECT DISTINCT `bank_name`,`bank_state`,`bank_district`,`bank_branch` FROM `bank_details` WHERE `bank_name` = '".$bankCC."' AND `bank_state` = '".$stateCC."' AND `bank_district` = '".$districtCC."' ORDER BY `bank_branch` ASC";
        
    } else if(!empty($stateCC)) {
		
		 // -- fetch districts query
        $dbQuery = "SELECT DISTINCT `bank_name`,`bank_state`,`bank_district` FROM `bank_details` WHERE `bank_name` = '".$bankCC."' AND `bank_state` = '".$stateCC."' ORDER BY `bank_district` ASC";
        
    } else if(!empty($bankCC)) {
		
		// -- fetch states query
        $dbQuery = "SELECT DISTINCT `bank_name`,`bank_state` FROM `bank_details` WHERE `bank_name` = '".$bankCC."' ORDER BY `bank_state` ASC";	

    } else {
        
        // home page title, page description and page keywords
		
		$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{

        $pageTitle = $row['meta_title_micr'];
        $pageDescription = $row['meta_description_micr'];
        $pageKeywords = $row['meta_keyword_micr'];
        }
		
		$hTitle = $row['home_micr_title'];
        $pDescription = $row['home_micr_description'];
		$pContent = $row['home_micr_content'];
        // -- fetch banks query
        $dbQuery = "SELECT DISTINCT `bank_name` FROM `contact_details` ORDER BY `bank_name` ASC";
		
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
 if(!empty($branchCC)) {
        
		
		$micrCC = ($results[0]['bank_micr']);
		$string = $micr_title_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[micrcode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$micrCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $micr_description_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[micrcode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$micrCC");
		$pageDescription = str_replace($find, $replace, $string);
        
        $pageKeywords = $bankCC . " " . $stateCC . "" . $branchCC . " MICR Code, " . $bankCC . " " . $branchCC . " MICR Code, " . $bankCC . " " . $branchCC . "" . $districtCC . " MICR Code details,";
		
		$string = $micr_heading_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[micrcode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$micrCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $micr_paragraph_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[micrcode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$micrCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$string = $micr_keywords_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[micrcode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$micrCC");
		$branchkeywords = str_replace($find, $replace, $string);
		
		$og_photo = $micr_photo;
		
        
    } else if(!empty($districtCC)) {
		
        
        // page title, page description and page keywords when bank, state and district selected
		$string = $micr_title_district;
		$find = array('[bank]', '[state]', '[district]');
		$replace = array("$bankCC", "$stateCC", "$districtCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $micr_description_district;
		$find = array('[bank]', '[state]', '[district]');
		$replace = array("$bankCC", "$stateCC", "$districtCC");
		$pageDescription = str_replace($find, $replace, $string);
        
        $pageKeywords = $bankCC . " " . $stateCC . " " . $districtCC . " MICR Code, " . $districtCC . " MICR Code " . $districtCC . " " . $stateCC . " All Branches list,";
		
		$string = $micr_heading_district;
		$find = array('[bank]', '[state]', '[district]');
		$replace = array("$bankCC", "$stateCC", "$districtCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $micr_paragraph_district;
		$find = array('[bank]', '[state]', '[district]');
		$replace = array("$bankCC", "$stateCC", "$districtCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $micr_photo;
        
        
        
    } else if(!empty($stateCC)) {
        
        // page title, page description and page keywords when bank and state selected
		$string = $micr_title_state;
		$find = array('[bank]', '[state]');
		$replace = array("$bankCC", "$stateCC");
		$pageTitle = str_replace($find, $replace, $string);
        
		$string = $micr_description_state;
		$find = array('[bank]', '[state]');
		$replace = array("$bankCC", "$stateCC");
		$pageDescription = str_replace($find, $replace, $string);
		
        $pageKeywords = $bankCC . " " . $stateCC . " MICR Code, " . $stateCC . " " . $bankCC . " MICR Code list,";
		
		$string = $micr_heading_state;
		$find = array('[bank]', '[state]');
		$replace = array("$bankCC", "$stateCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $micr_paragraph_state;
		$find = array('[bank]', '[state]');
		$replace = array("$bankCC", "$stateCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $micr_photo;
        
        
        
    } else if(!empty($bankCC)) {
        
        // page title, page description and page keywords when bank selected
		$string = $micr_title_bank;
		$find = array('[bank]');
		$replace = array("$bankCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $micr_description_bank;
		$find = array('[bank]');
		$replace = array("$bankCC");
		$pageDescription = str_replace($find, $replace, $string);
		
        $pageKeywords = $bankCC . " MICR Code List, ". $bankCC . " states MICR Code,";
		
		$string = $micr_heading_bank;
		$find = array('[bank]');
		$replace = array("$bankCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $micr_paragraph_bank;
		$find = array('[bank]');
		$replace = array("$bankCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $micr_photo;
        
        
		

    }     
} 

?>
<?php require 'header.php'; ?>