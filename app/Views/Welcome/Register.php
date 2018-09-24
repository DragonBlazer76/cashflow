        
                    <div id="companyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="close btn-3d" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Company Found!</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <h4 id="lblCompany"></h4>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                                    <!--button id="btnCancelMdl" name="btnCancelMdl" type="button" class="btn btn-3d btn-danger">Cancel Changes</button-->
                                </div>

                            </div>
                        </div>
                    </div>

        <div class="padding-15">

			<div class="login-box" style="margin-top:5%;max-width:500px">

               <div id="divLoginErr" name="divLoginErr" class="alert alert-danger" style="margin-bottom: 0px;display:none;"><!-- DANGER -->
                    <label id="divErrorSignInLabel" name="divErrorSignInLabel">Error</label>
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                
				<!-- registration form -->
				<form id="register_form" name="register_form" action="register2" method="post" class="sky-form boxed">
					<header><i class="fa fa-users"></i> Create Account <small class="note bold">IT'S FREE</small></header>
                    <input id="supplier_id" name="supplier_id" type="hidden">
					
					<fieldset>					
						<label class="input">
							<i class="icon-append fa fa-envelope"></i>
							<input id="email" name="email" type="text" placeholder="Email address *" required>
							<b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
						</label>
					
						<label class="input">
							<i class="icon-append fa fa-lock"></i>
							<input id="new_pwd" name="new_pwd" type="password" placeholder="Password *" required>
							<b class="tooltip tooltip-bottom-right">Password needs at least 8 characters long, alphanumeric with at least 1 cap</b>
						</label>
					
						<label class="input">
							<i class="icon-append fa fa-lock"></i>
							<input id="cfm_pwd" name="cfm_pwd" type="password" placeholder="Confirm password *" required>
							<b class="tooltip tooltip-bottom-right">Password needs at least 8 characters long, alphanumeric with at least 1 cap</b>
						</label>
					</fieldset>
						
					<fieldset>
						<div class="row" style="margin-bottom:0px;">
							<div class="col-md-6">
								<label class="input">
									<input id="first_name" name="first_name" type="text" placeholder="First name *" required>
								</label>
							</div>
							<div class="col col-md-6">
								<label class="input">
									<input id="last_name" name="last_name" type="text" placeholder="Last name *" required>
								</label>
							</div>
						</div>
                        
                        <label class="input">
							<input id="company_name" name="company_name" type="text" placeholder="Company name *" required>
						</label>

						<label class="select">
							<select id="sel_country" name="sel_country" required>
                                <option value="" disabled selected>-- Select a country * --</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AX">Åland Islands</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                                <option value="AR">Argentina</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AU">Australia</option>
                                <option value="AT">Austria</option>
                                <option value="AZ">Azerbaijan</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrain</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BY">Belarus</option>
                                <option value="BE">Belgium</option>
                                <option value="BZ">Belize</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermuda</option>
                                <option value="BT">Bhutan</option>
                                <option value="BO">Bolivia, Plurinational State of</option>
                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                <option value="BA">Bosnia and Herzegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BV">Bouvet Island</option>
                                <option value="BR">Brazil</option>
                                <option value="IO">British Indian Ocean Territory</option>
                                <option value="BN">Brunei Darussalam</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="KH">Cambodia</option>
                                <option value="CM">Cameroon</option>
                                <option value="CA">Canada</option>
                                <option value="CV">Cape Verde</option>
                                <option value="KY">Cayman Islands</option>
                                <option value="CF">Central African Republic</option>
                                <option value="TD">Chad</option>
                                <option value="CL">Chile</option>
                                <option value="CN">China</option>
                                <option value="CX">Christmas Island</option>
                                <option value="CC">Cocos (Keeling) Islands</option>
                                <option value="CO">Colombia</option>
                                <option value="KM">Comoros</option>
                                <option value="CG">Congo</option>
                                <option value="CD">Congo, the Democratic Republic of the</option>
                                <option value="CK">Cook Islands</option>
                                <option value="CR">Costa Rica</option>
                                <option value="CI">Côte d'Ivoire</option>
                                <option value="HR">Croatia</option>
                                <option value="CU">Cuba</option>
                                <option value="CW">Curaçao</option>
                                <option value="CY">Cyprus</option>
                                <option value="CZ">Czech Republic</option>
                                <option value="DK">Denmark</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="DO">Dominican Republic</option>
                                <option value="EC">Ecuador</option>
                                <option value="EG">Egypt</option>
                                <option value="SV">El Salvador</option>
                                <option value="GQ">Equatorial Guinea</option>
                                <option value="ER">Eritrea</option>
                                <option value="EE">Estonia</option>
                                <option value="ET">Ethiopia</option>
                                <option value="FK">Falkland Islands (Malvinas)</option>
                                <option value="FO">Faroe Islands</option>
                                <option value="FJ">Fiji</option>
                                <option value="FI">Finland</option>
                                <option value="FR">France</option>
                                <option value="GF">French Guiana</option>
                                <option value="PF">French Polynesia</option>
                                <option value="TF">French Southern Territories</option>
                                <option value="GA">Gabon</option>
                                <option value="GM">Gambia</option>
                                <option value="GE">Georgia</option>
                                <option value="DE">Germany</option>
                                <option value="GH">Ghana</option>
                                <option value="GI">Gibraltar</option>
                                <option value="GR">Greece</option>
                                <option value="GL">Greenland</option>
                                <option value="GD">Grenada</option>
                                <option value="GP">Guadeloupe</option>
                                <option value="GU">Guam</option>
                                <option value="GT">Guatemala</option>
                                <option value="GG">Guernsey</option>
                                <option value="GN">Guinea</option>
                                <option value="GW">Guinea-Bissau</option>
                                <option value="GY">Guyana</option>
                                <option value="HT">Haiti</option>
                                <option value="HM">Heard Island and McDonald Islands</option>
                                <option value="VA">Holy See (Vatican City State)</option>
                                <option value="HN">Honduras</option>
                                <option value="HK">Hong Kong</option>
                                <option value="HU">Hungary</option>
                                <option value="IS">Iceland</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IR">Iran, Islamic Republic of</option>
                                <option value="IQ">Iraq</option>
                                <option value="IE">Ireland</option>
                                <option value="IM">Isle of Man</option>
                                <option value="IL">Israel</option>
                                <option value="IT">Italy</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japan</option>
                                <option value="JE">Jersey</option>
                                <option value="JO">Jordan</option>
                                <option value="KZ">Kazakhstan</option>
                                <option value="KE">Kenya</option>
                                <option value="KI">Kiribati</option>
                                <option value="KP">Korea, Democratic People's Republic of</option>
                                <option value="KR">Korea, Republic of</option>
                                <option value="KW">Kuwait</option>
                                <option value="KG">Kyrgyzstan</option>
                                <option value="LA">Lao People's Democratic Republic</option>
                                <option value="LV">Latvia</option>
                                <option value="LB">Lebanon</option>
                                <option value="LS">Lesotho</option>
                                <option value="LR">Liberia</option>
                                <option value="LY">Libya</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Lithuania</option>
                                <option value="LU">Luxembourg</option>
                                <option value="MO">Macao</option>
                                <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                <option value="MG">Madagascar</option>
                                <option value="MW">Malawi</option>
                                <option value="MY">Malaysia</option>
                                <option value="MV">Maldives</option>
                                <option value="ML">Mali</option>
                                <option value="MT">Malta</option>
                                <option value="MH">Marshall Islands</option>
                                <option value="MQ">Martinique</option>
                                <option value="MR">Mauritania</option>
                                <option value="MU">Mauritius</option>
                                <option value="YT">Mayotte</option>
                                <option value="MX">Mexico</option>
                                <option value="FM">Micronesia, Federated States of</option>
                                <option value="MD">Moldova, Republic of</option>
                                <option value="MC">Monaco</option>
                                <option value="MN">Mongolia</option>
                                <option value="ME">Montenegro</option>
                                <option value="MS">Montserrat</option>
                                <option value="MA">Morocco</option>
                                <option value="MZ">Mozambique</option>
                                <option value="MM">Myanmar</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NP">Nepal</option>
                                <option value="NL">Netherlands</option>
                                <option value="NC">New Caledonia</option>
                                <option value="NZ">New Zealand</option>
                                <option value="NI">Nicaragua</option>
                                <option value="NE">Niger</option>
                                <option value="NG">Nigeria</option>
                                <option value="NU">Niue</option>
                                <option value="NF">Norfolk Island</option>
                                <option value="MP">Northern Mariana Islands</option>
                                <option value="NO">Norway</option>
                                <option value="OM">Oman</option>
                                <option value="PK">Pakistan</option>
                                <option value="PW">Palau</option>
                                <option value="PS">Palestinian Territory, Occupied</option>
                                <option value="PA">Panama</option>
                                <option value="PG">Papua New Guinea</option>
                                <option value="PY">Paraguay</option>
                                <option value="PE">Peru</option>
                                <option value="PH">Philippines</option>
                                <option value="PN">Pitcairn</option>
                                <option value="PL">Poland</option>
                                <option value="PT">Portugal</option>
                                <option value="PR">Puerto Rico</option>
                                <option value="QA">Qatar</option>
                                <option value="RE">Réunion</option>
                                <option value="RO">Romania</option>
                                <option value="RU">Russian Federation</option>
                                <option value="RW">Rwanda</option>
                                <option value="BL">Saint Barthélemy</option>
                                <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                <option value="KN">Saint Kitts and Nevis</option>
                                <option value="LC">Saint Lucia</option>
                                <option value="MF">Saint Martin (French part)</option>
                                <option value="PM">Saint Pierre and Miquelon</option>
                                <option value="VC">Saint Vincent and the Grenadines</option>
                                <option value="WS">Samoa</option>
                                <option value="SM">San Marino</option>
                                <option value="ST">Sao Tome and Principe</option>
                                <option value="SA">Saudi Arabia</option>
                                <option value="SN">Senegal</option>
                                <option value="RS">Serbia</option>
                                <option value="SC">Seychelles</option>
                                <option value="SL">Sierra Leone</option>
                                <option value="SG">Singapore</option>
                                <option value="SX">Sint Maarten (Dutch part)</option>
                                <option value="SK">Slovakia</option>
                                <option value="SI">Slovenia</option>
                                <option value="SB">Solomon Islands</option>
                                <option value="SO">Somalia</option>
                                <option value="ZA">South Africa</option>
                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                <option value="SS">South Sudan</option>
                                <option value="ES">Spain</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="SD">Sudan</option>
                                <option value="SR">Suriname</option>
                                <option value="SJ">Svalbard and Jan Mayen</option>
                                <option value="SZ">Swaziland</option>
                                <option value="SE">Sweden</option>
                                <option value="CH">Switzerland</option>
                                <option value="SY">Syrian Arab Republic</option>
                                <option value="TW">Taiwan, Province of China</option>
                                <option value="TJ">Tajikistan</option>
                                <option value="TZ">Tanzania, United Republic of</option>
                                <option value="TH">Thailand</option>
                                <option value="TL">Timor-Leste</option>
                                <option value="TG">Togo</option>
                                <option value="TK">Tokelau</option>
                                <option value="TO">Tonga</option>
                                <option value="TT">Trinidad and Tobago</option>
                                <option value="TN">Tunisia</option>
                                <option value="TR">Turkey</option>
                                <option value="TM">Turkmenistan</option>
                                <option value="TC">Turks and Caicos Islands</option>
                                <option value="TV">Tuvalu</option>
                                <option value="UG">Uganda</option>
                                <option value="UA">Ukraine</option>
                                <option value="AE">United Arab Emirates</option>
                                <option value="GB">United Kingdom</option>
                                <option value="US">United States</option>
                                <option value="UM">United States Minor Outlying Islands</option>
                                <option value="UY">Uruguay</option>
                                <option value="UZ">Uzbekistan</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VE">Venezuela, Bolivarian Republic of</option>
                                <option value="VN">Viet Nam</option>
                                <option value="VG">Virgin Islands, British</option>
                                <option value="VI">Virgin Islands, U.S.</option>
                                <option value="WF">Wallis and Futuna</option>
                                <option value="EH">Western Sahara</option>
                                <option value="YE">Yemen</option>
                                <option value="ZM">Zambia</option>
                                <option value="ZW">Zimbabwe</option>
							</select>
							<i></i>
						</label>
                        <label class="switch switch-default switch-round" style="margin-top:10px;">
                            I want to login as a &nbsp;<input id="chk_buyer" name="chk_buyer" type="checkbox" checked="">
                            <span id="span_buyer" class="switch-label" data-on="Buyer" data-off="Seller"></span>&nbsp;&nbsp;first
                        </label>
                    </fieldset>
                    <fieldset>
						<div class="margin-top20">
							<label class="checkbox nomargin">
                                <input id="chk_agree" class="checked-agree" type="checkbox" name="chk_agree" required><i></i>I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms of Service</a> *
                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                            </label>
							<label class="checkbox nomargin">
                                <input id="chk_news" type="checkbox" name="chk_news"><i></i>I want to receive news and  special offers
                            </label>
						</div>
					</fieldset>

					<footer>
						<button type="submit" class="btn btn-primary pull-right"><i style='text-align: center;padding-right: 0px; display: none;' class="fa fa-spinner fa-pulse fa-fw" id="icnSpinner" name="icnSpinner"></i><i id="icnCheck" name="icnCheck" class="fa fa-check"></i> Register</button>
						<div class="forgot-password pull-left">
                            <small class="note bold"><a href="/login">Back to Login</a> <br /></small>
						</div>
					</footer>

				</form>
				<!-- /registration form -->

				<!--hr />

				<div class="text-center">
					Or sign up using:
				</div>


				<div class="socials margin-top-10 text-center">
					<a href="#" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
					<a href="#" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
				</div-->

			</div>

		</div>

		<!-- MODAL -->
		<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModal">Terms &amp; Conditions</h4>
					</div>

					<div class="modal-body modal-terms">
						<h4><b>Introduction</b></h4>
						<p>These terms and conditions govern your use of this website; by using this website, you accept these terms and conditions in full.   If you disagree with these terms and conditions or any part of these terms and conditions, you must not use this website.</p>
						<p>[You must be at least [18] years of age to use this website.  By using this website [and by agreeing to these terms and conditions] you warrant and represent that you are at least [18] years of age.]</p>


						<h4><strong>License to use website</strong></h4>
						<p>Unless otherwise stated, [NAME] and/or its licensors own the intellectual property rights in the website and material on the website.  Subject to the license below, all these intellectual property rights are reserved.</p>
						<p>You may view, download for caching purposes only, and print pages [or [OTHER CONTENT]] from the website for your own personal use, subject to the restrictions set out below and elsewhere in these terms and conditions.</p>
						<p>You must not:</p>
						<ul>
							<li>republish material from this website (including republication on another website);</li>
							<li>sell, rent or sub-license material from the website;</li>
							<li>show any material from the website in public;</li>
							<li>reproduce, duplicate, copy or otherwise exploit material on this website for a commercial purpose;]</li>
							<li>[edit or otherwise modify any material on the website; or]</li>
							<li>[redistribute material from this website [except for content specifically and expressly made available for redistribution].]</li>
						</ul>
						<p>[Where content is specifically made available for redistribution, it may only be redistributed [within your organisation].]</p>

						<h4><strong>Acceptable use</strong></h4>
						<p>You must not use this website in any way that causes, or may cause, damage to the website or impairment of the availability or accessibility of the website; or in any way which is unlawful, illegal, fraudulent or harmful, or in connection with any unlawful, illegal, fraudulent or harmful purpose or activity.</p>
						<p>You must not use this website to copy, store, host, transmit, send, use, publish or distribute any material which consists of (or is linked to) any spyware, computer virus, Trojan horse, worm, keystroke logger, rootkit or other malicious computer software.</p>
						<p>You must not conduct any systematic or automated data collection activities (including without limitation scraping, data mining, data extraction and data harvesting) on or in relation to this website without [NAME'S] express written consent.</p>
						<p>[You must not use this website to transmit or send unsolicited commercial communications.]</p>
						<p>[You must not use this website for any purposes related to marketing without [NAME'S] express written consent.]</p>

						<h4><strong>Restricted access</strong></h4>
						<p>[Access to certain areas of this website is restricted.]  [NAME] reserves the right to restrict access to [other] areas of this website, or indeed this entire website, at [NAME'S] discretion.</p>
						<p>If [NAME] provides you with a user ID and password to enable you to access restricted areas of this website or other content or services, you must ensure that the user ID and password are kept confidential.</p>
						<p>[[NAME] may disable your user ID and password in [NAME'S] sole discretion without notice or explanation.]</p>

						<h4><strong>User content</strong></h4>
						<p>In these terms and conditions, “your user content” means material (including without limitation text, images, audio material, video material and audio-visual material) that you submit to this website, for whatever purpose.</p>
						<p>You grant to [NAME] a worldwide, irrevocable, non-exclusive, royalty-free license to use, reproduce, adapt, publish, translate and distribute your user content in any existing or future media.  You also grant to [NAME] the right to sub-license these rights, and the right to bring an action for infringement of these rights.</p>
						<p>Your user content must not be illegal or unlawful, must not infringe any third party's legal rights, and must not be capable of giving rise to legal action whether against you or [NAME] or a third party (in each case under any applicable law).</p>
						<p>You must not submit any user content to the website that is or has ever been the subject of any threatened or actual legal proceedings or other similar complaint.</p>
						<p>[NAME] reserves the right to edit or remove any material submitted to this website, or stored on [NAME'S] servers, or hosted or published upon this website.</p>
						<p>[Notwithstanding [NAME'S] rights under these terms and conditions in relation to user content, [NAME] does not undertake to monitor the submission of such content to, or the publication of such content on, this website.]</p>

						<h4><strong>No warranties</strong></h4>
						<p>This website is provided “as is” without any representations or warranties, express or implied.  [NAME] makes no representations or warranties in relation to this website or the information and materials provided on this website.</p>
						<p>Without prejudice to the generality of the foregoing paragraph, [NAME] does not warrant that:</p>
						<ul>
							<li>this website will be constantly available, or available at all; or</li>
							<li>the information on this website is complete, true, accurate or non-misleading.</li>
						</ul>
						<p>Nothing on this website constitutes, or is meant to constitute, advice of any kind.  [If you require advice in relation to any [legal, financial or medical] matter you should consult an appropriate professional.]</p>

						<h4><strong>Limitations of liability</strong></h4>
						<p>[NAME] will not be liable to you (whether under the law of contact, the law of torts or otherwise) in relation to the contents of, or use of, or otherwise in connection with, this website:</p>
						<ul>
							<li>[to the extent that the website is provided free-of-charge, for any direct loss;]</li>
							<li>for any indirect, special or consequential loss; or</li>
							<li>for any business losses, loss of revenue, income, profits or anticipated savings, loss of contracts or business relationships, loss of reputation or goodwill, or loss or corruption of information or data.</li>
						</ul>
						<p>These limitations of liability apply even if [NAME] has been expressly advised of the potential loss.</p>

						<h4><strong>Exceptions</strong></h4>
						<p>Nothing in this website disclaimer will exclude or limit any warranty implied by law that it would be unlawful to exclude or limit; and nothing in this website disclaimer will exclude or limit [NAME'S] liability in respect of any:</p>
						<ul>
							<li>death or personal injury caused by [NAME'S] negligence;</li>
							<li>fraud or fraudulent misrepresentation on the part of [NAME]; or</li>
							<li>matter which it would be illegal or unlawful for [NAME] to exclude or limit, or to attempt or purport to exclude or limit, its liability.</li>
						</ul>

						<h4><strong>Reasonableness</strong></h4>
						<p>By using this website, you agree that the exclusions and limitations of liability set out in this website disclaimer are reasonable.</p>
						<p>If you do not think they are reasonable, you must not use this website.</p>

						<h4><strong>Other parties</strong></h4>
						<p>[You accept that, as a limited liability entity, [NAME] has an interest in limiting the personal liability of its officers and employees.  You agree that you will not bring any claim personally against [NAME'S] officers or employees in respect of any losses you suffer in connection with the website.]</p>
						<p>[Without prejudice to the foregoing paragraph,] you agree that the limitations of warranties and liability set out in this website disclaimer will protect [NAME'S] officers, employees, agents, subsidiaries, successors, assigns and sub-contractors as well as [NAME].</p>

						<h4><strong>Unenforceable provisions</strong></h4>
						<p>If any provision of this website disclaimer is, or is found to be, unenforceable under applicable law, that will not affect the enforceability of the other provisions of this website disclaimer.</p>

						<h4><strong>Indemnity</strong></h4>
						<p>You hereby indemnify [NAME] and undertake to keep [NAME] indemnified against any losses, damages, costs, liabilities and expenses (including without limitation legal expenses and any amounts paid by [NAME] to a third party in settlement of a claim or dispute on the advice of [NAME'S] legal advisers) incurred or suffered by [NAME] arising out of any breach by you of any provision of these terms and conditions[, or arising out of any claim that you have breached any provision of these terms and conditions].</p>

						<h4><strong>Breaches of these terms and conditions</strong></h4>
						<p>Without prejudice to [NAME'S] other rights under these terms and conditions, if you breach these terms and conditions in any way, [NAME] may take such action as [NAME] deems appropriate to deal with the breach, including suspending your access to the website, prohibiting you from accessing the website, blocking computers using your IP address from accessing the website, contacting your internet service provider to request that they block your access to the website and/or bringing court proceedings against you.</p>

						<h4><strong>Variation</strong></h4>
						<p>[NAME] may revise these terms and conditions from time-to-time.  Revised terms and conditions will apply to the use of this website from the date of the publication of the revised terms and conditions on this website.  Please check this page regularly to ensure you are familiar with the current version.</p>

						<h4><strong>Assignment</strong></h4>
						<p>[NAME] may transfer, sub-contract or otherwise deal with [NAME'S] rights and/or obligations under these terms and conditions without notifying you or obtaining your consent.</p>
						<p>You may not transfer, sub-contract or otherwise deal with your rights and/or obligations under these terms and conditions.</p>

						<h4><strong>Severability</strong></h4>
						<p>If a provision of these terms and conditions is determined by any court or other competent authority to be unlawful and/or unenforceable, the other provisions will continue in effect.  If any unlawful and/or unenforceable provision would be lawful or enforceable if part of it were deleted, that part will be deemed to be deleted, and the rest of the provision will continue in effect.</p>

						<h4><strong>Entire agreement</strong></h4>
						<p>These terms and conditions [, together with [DOCUMENTS],] constitute the entire agreement between you and [NAME] in relation to your use of this website, and supersede all previous agreements in respect of your use of this website.</p>

						<h4><strong>Law and jurisdiction</strong></h4>
						<p>These terms and conditions will be governed by and construed in accordance with [GOVERNING LAW], and any disputes relating to these terms and conditions will be subject to the [non-]exclusive jurisdiction of the courts of [JURISDICTION].</p>

						<h4><strong>About these website terms and conditions</strong></h4>
						<p>
							We created these website terms and conditions with the help of a free website terms and conditions form developed by Contractology and available at <a href="#">www.yourwebsite.com</a>.
							Contractology supply a wide variety of commercial legal documents, such as <a href="#">template data protection statements</a>.
						</p>

						<h4><strong>Registrations and authorisations</strong></h4>
						<p>[[NAME] is registered with [TRADE REGISTER].  You can find the online version of the register at [URL].  [NAME'S] registration number is [NUMBER].]</p>
						<p>[[NAME] is subject to [AUTHORISATION SCHEME], which is supervised by [SUPERVISORY AUTHORITY].]</p>
						<p>[[NAME] is registered with [PROFESSIONAL BODY].  [NAME'S] professional title is [TITLE] and it has been granted in [JURISDICTION].  [NAME] is subject to the [RULES] which can be found at [URL].]</p>
						<p>[[NAME] subscribes to the following code[s] of conduct: [CODE(S) OF CONDUCT].  [These codes/this code] can be consulted electronically at [URL(S)].</p>
						<p>[[NAME'S] [TAX] number is [NUMBER].]]</p>

						<h4><strong>[NAME'S] details</strong></h4>
						<p>The full name of [NAME] is [FULL NAME].</p>
						<p>[[NAME] is registered in [JURISDICTION] under registration number [NUMBER].]</p>
						<p>[NAME'S] [registered] address is [ADDRESS].</p>
						<p>You can contact [NAME] by email to [EMAIL].</p>


						<p class="margin-top30">
							<strong>By using this  WEBSITE TERMS AND CONDITIONS template document, you agree to the 
							<a href="#">terms and conditions</a> set out on 
							<a href="#">yourdomain.com</a>.  You must retain the credit 
							set out in the section headed "ABOUT THESE WEBSITE TERMS AND CONDITIONS".  Subject to the licensing restrictions, you should 
							edit the document, adapting it to the requirements of your jurisdiction, your business and your 
							website.  If you are not a lawyer, we recommend that you take professional legal advice in relation to the editing and 
							use of the template.</strong>
						</p>


					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" id="terms-agree"><i class="fa fa-check"></i> I Agree</button>
						
						<button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Print</button>
					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<!-- /MODAL -->

<?php
    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/login.js', 'smarty'),
    ]);

    echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

?>

        <!-- PAGE LEVEL SCRIPTS -->
		<script type="text/javascript">

			/**
				Checkbox on "I agree" modal Clicked!
			**/
			jQuery("#terms-agree").click(function(){
				jQuery('#termsModal').modal('toggle');

				// Check Terms and Conditions checkbox if not already checked!
				if(!jQuery("#checked-agree").checked) {
					jQuery("input.checked-agree").prop('checked', true);
				}
				
			});
		</script>