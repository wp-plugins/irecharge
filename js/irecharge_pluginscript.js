function load_irecharge_cookie(){try{var e=$.cookie("vtu_network");if(void 0!=e&&null!=e&&""!=e){var t=$.cookie("vtu_amount"),o=$.cookie("vtu_number"),u=$.cookie("vtu_email");document.getElementById("vtu_email").value=u,document.getElementById("vtu_amount").value=t,document.getElementById("selected_network").value=e,document.getElementById("vtu_number").value=o}}catch(n){}}jQuery(document).ready(function(e){e("#irecharge_i_button").click(function(){var t=document.location.href,o=document.getElementById("vendorId").value,u=document.getElementById("selected_network").value,n=document.getElementById("vtu_amount").value,c=document.getElementById("vtu_number").value,l=document.getElementById("vtu_email").value;if(""!=c&&n>0&&""!=u&&""!=l){var a="http://irecharge.ihub.systems/topup_plugin_process_ints.php?vtu_network="+u+"&vtu_amount="+n+"&vtu_number="+c+"&vtu_email="+l+"&vendor_id="+o+"&vtu_source="+t;window.open(a,"_blank","toolbar=0,location=0,menubar=0, width=600, height=600");try{e.cookie("vtu_network",u),e.cookie("vtu_amount",n),e.cookie("vtu_number",c),e.cookie("vtu_email",l)}catch(i){}}else alert("Please complete all fields to continue")}),e("#topup_form8975").click(function(){e("#top_up_support123").fadeIn()}),load_irecharge_cookie()});