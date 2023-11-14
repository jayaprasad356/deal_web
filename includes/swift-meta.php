<?php require_once('mod_rewrite.php'); ?>

<?php

$requestedPage = basename($_SERVER["SCRIPT_FILENAME"], '.php');

if($requestedPage === "index") {
    
    $countryCC = filterInput($_GET['country']);
    $bankCC = filterInput($_GET['bank']);
    $cityCC = filterInput($_GET['city']);
    $branchCC = filterInput($_GET['branch']);
    
    if(!empty($branchCC)) {
        
        $dbQuery = "SELECT * FROM `swift_details` WHERE `country` = '".$countryCC."' AND `branch` = '".$branchCC."' LIMIT 1";
        
    } else if(!empty($cityCC)) {

         // -- fetch citys query
        $dbQuery = "SELECT DISTINCT `country`,`bank`,`city`,`branch`,`swift_code` FROM `swift_details` WHERE `country` = '".$countryCC."' AND `bank` = '".$bankCC."' AND `city` = '".$cityCC."' ORDER BY `branch`,`swift_code` ASC";
        
    } else if(!empty($bankCC)) {
		
         // -- fetch citys query
        $dbQuery = "SELECT DISTINCT `country`,`bank`,`city` FROM `swift_details` WHERE `country` = '".$countryCC."' AND `bank` = '".$bankCC."' ORDER BY `city` ASC";
        
    } else if(!empty($countryCC)) {
        
        // -- fetch banks query
        $dbQuery = "SELECT DISTINCT `country`,`bank` FROM `swift_details` WHERE `country` = '".$countryCC."' ORDER BY `bank` ASC";
		

    } else {
        
        // home page title, page description and page keywords
		
		$bankment = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
		$bankment->execute();
		$result = $bankment->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{

        $pageTitle = $row['meta_title_swift'];
        $pageDescription = $row['meta_description_swift'];
        $pageKeywords = $row['meta_keyword_swift'];
        }
		
		$hTitle = $row['home_swift_title'];
        $pDescription = $row['home_swift_description'];
		$pContent = $row['home_swift_content'];
        // -- fetch banks query
        $dbQuery = "SELECT DISTINCT `country`,`country_code` FROM `swift_details` ORDER BY `country` ASC";
		
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
        
		
		$swiftCC = ($results[0]['swift_code']);
		$shortCC = ($results[0]['country_code']);
		$string = $swift_title_branch;
		$find = array('[country]', '[countryshort]', '[bank]', '[city]', '[branch]', '[swiftcode]');
		$replace = array("$countryCC", "$shortCC", "$bankCC", "$cityCC", "$branchCC", "$swiftCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $swift_description_branch;
		$find = array('[country]', '[countryshort]', '[bank]', '[city]', '[branch]', '[swiftcode]');
		$replace = array("$countryCC", "$shortCC", "$bankCC", "$cityCC", "$branchCC", "$swiftCC");
		$pageDescription = str_replace($find, $replace, $string);
        
        $pageKeywords = $countryCC . " " . $bankCC . "" . $branchCC . " swift Code, " . $countryCC . " " . $branchCC . " swift Code, " . $countryCC . " " . $branchCC . "" . $cityCC . " swift Code details,";
		
		$string = $swift_heading_branch;
		$find = array('[country]', '[countryshort]', '[bank]', '[city]', '[branch]', '[swiftcode]');
		$replace = array("$countryCC", "$shortCC", "$bankCC", "$cityCC", "$branchCC", "$swiftCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $swift_paragraph_branch;
		$find = array('[country]', '[countryshort]', '[bank]', '[city]', '[branch]', '[swiftcode]');
		$replace = array("$countryCC", "$shortCC", "$bankCC", "$cityCC", "$branchCC", "$swiftCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$string = $swift_keywords_branch;
		$find = array('[country]', '[countryshort]', '[bank]', '[city]', '[branch]', '[swiftcode]');
		$replace = array("$countryCC", "$shortCC", "$bankCC", "$cityCC", "$branchCC", "$swiftCC");
		$branchkeywords = str_replace($find, $replace, $string);
		
		$og_photo = $swift_photo;
        
    } else if(!empty($cityCC)) {
		
		$shortCC = ($results[0]['country_code']);
		$string = $swift_title_city;
		$find = array('[country]', '[countryshort]', '[bank]', '[city]');
		$replace = array("$countryCC", "$shortCC", "$bankCC", "$cityCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $swift_description_city;
		$find = array('[country]', '[countryshort]', '[bank]', '[city]');
		$replace = array("$countryCC", "$shortCC", "$bankCC", "$cityCC");
		$pageDescription = str_replace($find, $replace, $string);
        
        $pageKeywords = $bankCC . " swift code, " . $bankCC . " BIC code, " . $countryCC . "  " . $bankCC . " " . $cityCC . " city swift code list";
		
		$string = $swift_heading_city;
		$find = array('[country]', '[countryshort]', '[bank]', '[city]');
		$replace = array("$countryCC", "$shortCC", "$bankCC", "$cityCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $swift_paragraph_city;
		$find = array('[country]', '[countryshort]', '[bank]', '[city]');
		$replace = array("$countryCC", "$shortCC", "$bankCC", "$cityCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $swift_photo;
        
    } else if(!empty($bankCC)) {
		
		$shortCC = ($results[0]['country_code']);
		$string = $swift_title_bank;
		$find = array('[country]', '[countryshort]', '[bank]');
		$replace = array("$countryCC", "$shortCC", "$bankCC");
		$pageTitle = str_replace($find, $replace, $string);
        
		$string = $swift_description_bank;
		$find = array('[country]', '[countryshort]', '[bank]');
		$replace = array("$countryCC", "$shortCC", "$bankCC");
		$pageDescription = str_replace($find, $replace, $string);
		
        $pageKeywords = $countryCC . " " . $bankCC . " swift Code, " . $bankCC . " " . $countryCC . " swift Code list,";
		
		$string = $swift_heading_bank;
		$find = array('[country]', '[countryshort]', '[bank]');
		$replace = array("$countryCC", "$shortCC", "$bankCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $swift_paragraph_bank;
		$find = array('[country]', '[countryshort]', '[bank]');
		$replace = array("$countryCC", "$shortCC", "$bankCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $swift_photo;
        
    } else if(!empty($countryCC)) {

		
		$shortCC = ($results[0]['country_code']);
		$string = $swift_title_country;
		$find = array('[country]');
		$replace = array("$countryCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $swift_description_country;
		$find = array('[country]');
		$replace = array("$countryCC");
		$pageDescription = str_replace($find, $replace, $string);
		
        $pageKeywords = $countryCC . " swift Code List, ". $countryCC . " banks swift Code,";
		
		$string = $swift_heading_country;
		$find = array('[country]');
		$replace = array("$countryCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $swift_paragraph_country;
		$find = array('[country]');
		$replace = array("$countryCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $swift_photo;
		

    }        
} 

?>
<?php require 'header.php'; ?>