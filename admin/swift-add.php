<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['swift_code'])) {
        $valid = 0;
        $error_message .= "Swift Code can not be empty<br>";
    } 
	if(empty($_POST['country'])) {
        $valid = 0;
        $error_message .= "Country can not be empty<br>";
    }

    if(empty($_POST['city'])) {
        $valid = 0;
        $error_message .= "City code can not be empty<br>";
    }
    
    if(empty($_POST['bank'])) {
        $valid = 0;
        $error_message .= "You must have to select a Bank Name<br>";
    }
    if(empty($_POST['branch'])) {
        $valid = 0;
        $error_message .= "Branch can not be emptybr>";
    }
	
    if($valid == 1) {

    	// Getting auto increment id for this category
		$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'swift_details'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row) {
			$ai_id=$row[10];
		}


    	
    	
		// Saving data into the main table swift_details
		$statement = $pdo->prepare("INSERT INTO swift_details (bank,swift_code,branch,country,city, country_code,address) VALUES (?,?,?,?,?,?,?)");
		$statement->execute(array($_POST['bank'],$_POST['swift_code'],$_POST['branch'],$_POST['country'],$_POST['city'],$_POST['country_code'],$_POST['address']));
	

    	$success_message = 'Bank Swift Code Details is added successfully.';
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Bank Swift Code Details</h1>
	</div>
	<div class="content-header-right">
		<a href="swift.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php if($error_message): ?>
			<div class="callout callout-danger">
			<h4>Please correct the following errors:</h4>
			<p>
			<?php echo $error_message; ?>
			</p>
			</div>
			<?php endif; ?>

			<?php if($success_message): ?>
			<div class="callout callout-success">
			<h4>Success:</h4>
			<p><?php echo $success_message; ?></p>
			</div>
			<?php endif; ?>

			<form class="form-horizontal" action="" method="post">

				<div class="box box-info">
					<div class="box-body">
						
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Bank Name <span>*</span></label>
							<div class="col-sm-9">				
								<input type="text" class="form-control" name="bank" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);">
							</div>
							
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Swift BIC Code<span>*</span> </label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="swift_code">
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Branch<span>*</span> </label>
							<div class="col-sm-9">
							
								<input type="text" class="form-control" name="branch" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Country<span>*</span> </label>
							<div class="col-sm-4">
								<select name="country" class="form-control"><option value="">Select a Country</option>
								<option value="Afghanistan">Afghanistan (AF)</option>
    <option value="Albania">Albania (AL)</option>
    <option value="Algeria">Algeria (DZ)</option>
    <option value="American Samoa">American Samoa (AS)</option>
    <option value="Andorra">Andorra (AD)</option>
    <option value="Angola">Angola (AO)</option>
    <option value="Anguilla">Anguilla (AI)</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda (AG)</option>
    <option value="Argentina">Argentina (AR)</option>
    <option value="Aruba">Aruba (AW)</option>
    <option value="Australia">Australia (AU)</option>
    <option value="Austria">Austria (AT)</option>
    <option value="Azerbaijan">Azerbaijan (AZ)</option>
    <option value="Bahamas">Bahamas (BS)</option>
    <option value="Bahrain">Bahrain (BH)</option>
    <option value="Bangladesh">Bangladesh (BD)</option>
    <option value="Barbados">Barbados (BB)</option>
    <option value="Belarus">Belarus (BY)</option>
    <option value="Belgium">Belgium (BE)</option>
    <option value="Belize">Belize (BZ)</option>
    <option value="Benin">Benin (BJ)</option>
    <option value="Bermuda">Bermuda (BM)</option>
    <option value="Bhutan">Bhutan (BT)</option>
    <option value="Bolivia">Bolivia (BO)</option>
    <option value="Bonaire">Bonaire (BQ)</option>
    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina (BA)</option>
    <option value="Botswana">Botswana (BW)</option>
    <option value="Brazil">Brazil (BR)</option>
    <option value="Brunei">Brunei (BN)</option>
    <option value="Bulgaria">Bulgaria (BG)</option>
    <option value="Burkina Faso">Burkina Faso (BF)</option>
    <option value="Burundi">Burundi (BI)</option>
    <option value="Cambodia">Cambodia (KH)</option>
    <option value="Cameroon">Cameroon (CM)</option>
    <option value="Canada">Canada (CA)</option>
    <option value="Cape Verde">Cape Verde (CV)</option>
    <option value="Cayman Islands">Cayman Islands (KY)</option>
    <option value="Central African Republic">Central African Republic (CF)</option>
    <option value="Chad">Chad (TD)</option>
    <option value="Chile">Chile (CL)</option>
    <option value="China">China (CN)</option>
    <option value="Colombia">Colombia (CO)</option>
    <option value="Comoros">Comoros (KM)</option>
    <option value="Congo Democratic Republic">Congo Democratic Republic (CD)</option>
    <option value="Congo Republic">Congo Republic (CG)</option>
    <option value="Cook Islands">Cook Islands (CK)</option>
    <option value="Costa Rica">Costa Rica (CR)</option>
    <option value="Cote d Ivoire">Cote d Ivoire (CI)</option>
    <option value="Croatia">Croatia (HR)</option>
    <option value="Cuba">Cuba (CU)</option>
    <option value="Curacao">Curacao (CW)</option>
    <option value="Cyprus">Cyprus (CY)</option>
    <option value="Czech Republic">Czech Republic (CZ)</option>
    <option value="Denmark">Denmark (DK)</option>
    <option value="Djibouti">Djibouti (DJ)</option>
    <option value="Dominica">Dominica (DM)</option>
    <option value="Dominican Republic">Dominican Republic (DO)</option>
    <option value="Ecuador">Ecuador (EC)</option>
    <option value="Egypt">Egypt (EG)</option>
    <option value="El Salvador">El Salvador (SV)</option>
    <option value="Equatorial Guinea">Equatorial Guinea (GQ)</option>
    <option value="Eritrea">Eritrea (ER)</option>
    <option value="Estonia">Estonia (EE)</option>
    <option value="Ethiopia">Ethiopia (ET)</option>
    <option value="Falkland Islands">Falkland Islands (FK)</option>
    <option value="Faroe Islands">Faroe Islands (FO)</option>
    <option value="Fiji">Fiji (FJ)</option>
    <option value="Finland">Finland (FI)</option>
    <option value="France">France (FR)</option>
    <option value="French Guiana">French Guiana (GF)</option>
    <option value="French Polynesia">French Polynesia (PF)</option>
    <option value="Gabon">Gabon (GA)</option>
    <option value="Gambia">Gambia (GM)</option>
    <option value="Georgia">Georgia (GE)</option>
    <option value="Germany">Germany (DE)</option>
    <option value="Ghana">Ghana (GH)</option>
    <option value="Gibraltar">Gibraltar (GI)</option>
    <option value="Greece">Greece (GR)</option>
    <option value="Greenland">Greenland (GL)</option>
    <option value="Grenada">Grenada ()</option>
    <option value="Grenada">Grenada (GD)</option>
    <option value="Guadeloupe">Guadeloupe (GP)</option>
    <option value="Guam">Guam (GU)</option>
    <option value="Guatemala">Guatemala (GT)</option>
    <option value="Guernsey">Guernsey (GG)</option>
    <option value="Guinea">Guinea (GN)</option>
    <option value="Guinea Bissau">Guinea Bissau (GW)</option>
    <option value="Guyana">Guyana (GY)</option>
    <option value="Haiti">Haiti (HT)</option>
    <option value="Honduras">Honduras (HN)</option>
    <option value="Hong Kong">Hong Kong (HK)</option>
    <option value="Hungary">Hungary (HU)</option>
    <option value="Iceland">Iceland (IS)</option>
    <option value="India">India (IN)</option>
    <option value="Indonesia">Indonesia (ID)</option>
    <option value="Iran">Iran (IR)</option>
    <option value="Iraq">Iraq (IQ)</option>
    <option value="Ireland">Ireland (IE)</option>
    <option value="Isle of Man">Isle of Man (IM)</option>
    <option value="Israel">Israel (IL)</option>
    <option value="Italy">Italy (IT)</option>
    <option value="Jamaica">Jamaica (JM)</option>
    <option value="Japan">Japan (JP)</option>
    <option value="Jersey">Jersey (JE)</option>
    <option value="Jordan">Jordan (JO)</option>
    <option value="Kazakhstan">Kazakhstan (KZ)</option>
    <option value="Kenya">Kenya (KE)</option>
    <option value="Kiribati">Kiribati (KI)</option>
    <option value="Kosovo">Kosovo (XK)</option>
    <option value="Kuwait">Kuwait (KW)</option>
    <option value="Kyrgyzstan">Kyrgyzstan (KG)</option>
    <option value="Laos">Laos (LA)</option>
    <option value="Latvia">Latvia (LV)</option>
    <option value="Lebanon">Lebanon (LB)</option>
    <option value="Lesotho">Lesotho (LS)</option>
    <option value="Liberia">Liberia (LR)</option>
    <option value="Libya">Libya (LY)</option>
    <option value="Liechtenstein">Liechtenstein (LI)</option>
    <option value="Lithuania">Lithuania (LT)</option>
    <option value="Luxembourg">Luxembourg (LU)</option>
    <option value="Macao">Macao (MO)</option>
    <option value="Macedonia">Macedonia (MK)</option>
    <option value="Madagascar">Madagascar (MG)</option>
    <option value="Malawi">Malawi (MW)</option>
    <option value="Malaysia">Malaysia (MY)</option>
    <option value="Maldives">Maldives (MV)</option>
    <option value="Mali">Mali (ML)</option>
    <option value="Malta">Malta (MT)</option>
    <option value="Marshall Islands">Marshall Islands (MH)</option>
    <option value="Martinique">Martinique (MQ)</option>
    <option value="Mauritania">Mauritania (MR)</option>
    <option value="Mauritius">Mauritius (MU)</option>
    <option value="Mayotte">Mayotte (YT)</option>
    <option value="Mexico">Mexico (MX)</option>
    <option value="Micronesia">Micronesia (FM)</option>
    <option value="Moldova">Moldova (MD)</option>
    <option value="Monaco">Monaco (MC)</option>
    <option value="Mongolia">Mongolia (MN)</option>
    <option value="Montenegro">Montenegro (ME)</option>
    <option value="Montserrat">Montserrat (MS)</option>
    <option value="Morocco">Morocco (MA)</option>
    <option value="Mozambique">Mozambique (MZ)</option>
    <option value="Myanmar">Myanmar (MM)</option>
    <option value="Namibia">Namibia (NA)</option>
    <option value="Nauru">Nauru (NR)</option>
    <option value="Nepal">Nepal (NP)</option>
    <option value="Netherlands">Netherlands (NL)</option>
    <option value="New Caledonia">New Caledonia (NC)</option>
    <option value="New Zealand">New Zealand (NZ)</option>
    <option value="Nicaragua">Nicaragua (NI)</option>
    <option value="Niger">Niger (NE)</option>
    <option value="Nigeria">Nigeria (NG)</option>
    <option value="North Korea">North Korea (KP)</option>
    <option value="Northern Mariana Islands">Northern Mariana Islands (MP)</option>
    <option value="Norway">Norway (NO)</option>
    <option value="Oman">Oman (OM)</option>
    <option value="Pakistan">Pakistan (PK)</option>
    <option value="Palau">Palau (PW)</option>
    <option value="Palestine">Palestine (PS)</option>
    <option value="Panama">Panama (PA)</option>
    <option value="Papua New Guinea">Papua New Guinea (PG)</option>
    <option value="Paraguay">Paraguay (PY)</option>
    <option value="Peru">Peru (PE)</option>
    <option value="Philippines">Philippines (PH)</option>
    <option value="Poland">Poland (PL)</option>
    <option value="Portugal">Portugal (PT)</option>
    <option value="Puerto Rico">Puerto Rico (PR)</option>
    <option value="Qatar">Qatar (QA)</option>
    <option value="Reunion">Reunion (RE)</option>
    <option value="Romania">Romania (RO)</option>
    <option value="Russia">Russia (RU)</option>
    <option value="Rwanda">Rwanda (RW)</option>
    <option value="Saint Helena">Saint Helena (SH)</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis (KN)</option>
    <option value="Saint Lucia">Saint Lucia (LC)</option>
    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon (PM)</option>
    <option value="Samoa">Samoa (WS)</option>
    <option value="San Marino">San Marino (SM)</option>
    <option value="Sao Tome and Principe">Sao Tome and Principe (ST)</option>
    <option value="Saudi Arabia">Saudi Arabia (SA)</option>
    <option value="Senegal">Senegal (SN)</option>
    <option value="Serbia">Serbia (RS)</option>
    <option value="Seychelles">Seychelles (SC)</option>
    <option value="Sierra Leone">Sierra Leone (SL)</option>
    <option value="Singapore">Singapore (SG)</option>
    <option value="Sint Maarten">Sint Maarten (SX)</option>
    <option value="Slovakia">Slovakia (SK)</option>
    <option value="Slovenia">Slovenia (SI)</option>
    <option value="Solomon Islands">Solomon Islands (SB)</option>
    <option value="Somalia">Somalia (SO)</option>
    <option value="South Africa">South Africa (ZA)</option>
    <option value="South Korea">South Korea (KR)</option>
    <option value="South Sudan">South Sudan (SS)</option>
    <option value="Spain">Spain (ES)</option>
    <option value="Sri Lanka">Sri Lanka (LK)</option>
    <option value="St Vincent and Grenadines">St Vincent and Grenadines (VC)</option>
    <option value="Sudan">Sudan (SD)</option>
    <option value="Suriname">Suriname (SR)</option>
    <option value="Swaziland">Swaziland (SZ)</option>
    <option value="Sweden">Sweden (SE)</option>
    <option value="Switzerland">Switzerland (CH)</option>
    <option value="Syria">Syria (SY)</option>
    <option value="Taiwan">Taiwan (TW)</option>
    <option value="Tajikistan">Tajikistan (TJ)</option>
    <option value="Tanzania">Tanzania (TZ)</option>
    <option value="Thailand">Thailand (TH)</option>
    <option value="Timor Leste">Timor Leste (TL)</option>
    <option value="Togo">Togo (TG)</option>
    <option value="Tonga">Tonga (TO)</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago (TT)</option>
    <option value="Tunisia">Tunisia (TN)</option>
    <option value="Turkey">Turkey (TR)</option>
    <option value="Turkmenistan">Turkmenistan (TM)</option>
    <option value="Turks and Caicos Islands">Turks and Caicos Islands (TC)</option>
    <option value="Tuvalu">Tuvalu (TV)</option>
    <option value="Uganda">Uganda (UG)</option>
    <option value="Ukraine">Ukraine (UA)</option>
    <option value="United Arab Emirates">United Arab Emirates (AE)</option>
    <option value="United Kingdom">United Kingdom (GB)</option>
    <option value="United States">United States (US)</option>
    <option value="Uruguay">Uruguay (UY)</option>
    <option value="Uzbekistan">Uzbekistan (UZ)</option>
    <option value="Vanuatu">Vanuatu (VU)</option>
    <option value="Vatican City">Vatican City (VA)</option>
    <option value="Venezuela">Venezuela (VE)</option>
    <option value="Vietnam">Vietnam (VN)</option>
    <option value="Virgin Islands (UK)">Virgin Islands (UK) (VG)</option>
    <option value="Virgin Islands (US)">Virgin Islands (US) (VI)</option>
    <option value="Wallis and Futuna Islands">Wallis and Futuna Islands (WF)</option>
    <option value="Yemen">Yemen (YE)</option>
    <option value="Zambia">Zambia (ZM)</option>
    <option value="Zimbabwe">Zimbabwe (ZW)</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Country Code<span>*</span> </label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="country_code" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">City<span>*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="city"onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="address">
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>

			</form>


		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>