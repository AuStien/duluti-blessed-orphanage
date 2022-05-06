<!--

-->
<!DOCTYPE HTML>
<html>
	<head>
		<title>Duluti Blessed Orphanage</title>
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<!-- -->
		<script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>
            /*

                * Price Format jQuery Plugin
                * Created By Eduardo Cuducos
                * Currently maintained by Flavio Silveira flavio [at] gmail [dot] com
                * Version: 2.0
                * Release: 2014-01-26

            */

            (function($) {

                /****************
                 * Main Function *
                 *****************/
                $.fn.priceFormat = function(options)
                {

                    var defaults =
                        {
                            prefix: 'US$ ',
                            suffix: '',
                            centsSeparator: '.',
                            thousandsSeparator: ',',
                            limit: false,
                            centsLimit: 2,
                            clearPrefix: false,
                            clearSufix: false,
                            allowNegative: false,
                            insertPlusSign: false,
                            clearOnEmpty:false
                        };

                    var options = $.extend(defaults, options);

                    return this.each(function()
                    {
                        // pre defined options
                        var obj = $(this);
                        var value = '';
                        var is_number = /[0-9]/;

                        // Check if is an input
                        if(obj.is('input'))
                            value = obj.val();
                        else
                            value = obj.html();

                        // load the pluggings settings
                        var prefix = options.prefix;
                        var suffix = options.suffix;
                        var centsSeparator = options.centsSeparator;
                        var thousandsSeparator = options.thousandsSeparator;
                        var limit = options.limit;
                        var centsLimit = options.centsLimit;
                        var clearPrefix = options.clearPrefix;
                        var clearSuffix = options.clearSuffix;
                        var allowNegative = options.allowNegative;
                        var insertPlusSign = options.insertPlusSign;
                        var clearOnEmpty = options.clearOnEmpty;

                        // If insertPlusSign is on, it automatic turns on allowNegative, to work with Signs
                        if (insertPlusSign) allowNegative = true;

                        function set(nvalue)
                        {
                            if(obj.is('input'))
                                obj.val(nvalue);
                            else
                                obj.html(nvalue);
                        }

                        function get()
                        {
                            if(obj.is('input'))
                                value = obj.val();
                            else
                                value = obj.html();

                            return value;
                        }

                        // skip everything that isn't a number
                        // and also skip the left zeroes
                        function to_numbers (str)
                        {
                            var formatted = '';
                            for (var i=0;i<(str.length);i++)
                            {
                                char_ = str.charAt(i);
                                if (formatted.length==0 && char_==0) char_ = false;

                                if (char_ && char_.match(is_number))
                                {
                                    if (limit)
                                    {
                                        if (formatted.length < limit) formatted = formatted+char_;
                                    }
                                    else
                                    {
                                        formatted = formatted+char_;
                                    }
                                }
                            }

                            return formatted;
                        }

                        // format to fill with zeros to complete cents chars
                        function fill_with_zeroes (str)
                        {
                            while (str.length<(centsLimit+1)) str = '0'+str;
                            return str;
                        }

                        // format as price
                        function price_format (str, ignore)
                        {
                            if(!ignore && (str === '' || str == price_format('0', true)) && clearOnEmpty)
                                return '';

                            // formatting settings
                            var formatted = fill_with_zeroes(to_numbers(str));
                            var thousandsFormatted = '';
                            var thousandsCount = 0;

                            // Checking CentsLimit
                            if(centsLimit == 0)
                            {
                                centsSeparator = "";
                                centsVal = "";
                            }

                            // split integer from cents
                            var centsVal = formatted.substr(formatted.length-centsLimit,centsLimit);
                            var integerVal = formatted.substr(0,formatted.length-centsLimit);

                            // apply cents pontuation
                            formatted = (centsLimit==0) ? integerVal : integerVal+centsSeparator+centsVal;

                            // apply thousands pontuation
                            if (thousandsSeparator || $.trim(thousandsSeparator) != "")
                            {
                                for (var j=integerVal.length;j>0;j--)
                                {
                                    char_ = integerVal.substr(j-1,1);
                                    thousandsCount++;
                                    if (thousandsCount%3==0) char_ = thousandsSeparator+char_;
                                    thousandsFormatted = char_+thousandsFormatted;
                                }

                                //
                                if (thousandsFormatted.substr(0,1)==thousandsSeparator) thousandsFormatted = thousandsFormatted.substring(1,thousandsFormatted.length);
                                formatted = (centsLimit==0) ? thousandsFormatted : thousandsFormatted+centsSeparator+centsVal;
                            }

                            // if the string contains a dash, it is negative - add it to the begining (except for zero)
                            if (allowNegative && (integerVal != 0 || centsVal != 0))
                            {
                                if (str.indexOf('-') != -1 && str.indexOf('+')<str.indexOf('-') )
                                {
                                    formatted = '-' + formatted;
                                }
                                else
                                {
                                    if(!insertPlusSign)
                                        formatted = '' + formatted;
                                    else
                                        formatted = '+' + formatted;
                                }
                            }

                            // apply the prefix
                            if (prefix) formatted = prefix+formatted;

                            // apply the suffix
                            if (suffix) formatted = formatted+suffix;

                            return formatted;
                        }

                        // filter what user type (only numbers and functional keys)
                        function key_check (e)
                        {
                            var code = (e.keyCode ? e.keyCode : e.which);
                            var typed = String.fromCharCode(code);
                            var functional = false;
                            var str = value;
                            var newValue = price_format(str+typed);

                            // allow key numbers, 0 to 9
                            if((code >= 48 && code <= 57) || (code >= 96 && code <= 105)) functional = true;

                            // check Backspace, Tab, Enter, Delete, and left/right arrows
                            if (code ==  8) functional = true;
                            if (code ==  9) functional = true;
                            if (code == 13) functional = true;
                            if (code == 46) functional = true;
                            if (code == 37) functional = true;
                            if (code == 39) functional = true;
                            // Minus Sign, Plus Sign
                            if (allowNegative && (code == 189 || code == 109 || code == 173)) functional = true;
                            if (insertPlusSign && (code == 187 || code == 107 || code == 61)) functional = true;

                            if (!functional)
                            {

                                e.preventDefault();
                                e.stopPropagation();
                                if (str!=newValue) set(newValue);
                            }

                        }

                        // Formatted price as a value
                        function price_it ()
                        {
                            var str = get();
                            var price = price_format(str);
                            if (str != price) set(price);
                            if(parseFloat(str) == 0.0 && clearOnEmpty) set('');
                        }

                        // Add prefix on focus
                        function add_prefix()
                        {
                            obj.val(prefix + get());
                        }

                        function add_suffix()
                        {
                            obj.val(get() + suffix);
                        }

                        // Clear prefix on blur if is set to true
                        function clear_prefix()
                        {
                            if($.trim(prefix) != '' && clearPrefix)
                            {
                                var array = get().split(prefix);
                                set(array[1]);
                            }
                        }

                        // Clear suffix on blur if is set to true
                        function clear_suffix()
                        {
                            if($.trim(suffix) != '' && clearSuffix)
                            {
                                var array = get().split(suffix);
                                set(array[0]);
                            }
                        }

                        // bind the actions
                        obj.bind('keydown.price_format', key_check);
                        obj.bind('keyup.price_format', price_it);
                        obj.bind('focusout.price_format', price_it);

                        // Clear Prefix and Add Prefix
                        if(clearPrefix)
                        {
                            obj.bind('focusout.price_format', function()
                            {
                                clear_prefix();
                            });

                            obj.bind('focusin.price_format', function()
                            {
                                add_prefix();
                            });
                        }

                        // Clear Suffix and Add Suffix
                        if(clearSuffix)
                        {
                            obj.bind('focusout.price_format', function()
                            {
                                clear_suffix();
                            });

                            obj.bind('focusin.price_format', function()
                            {
                                add_suffix();
                            });
                        }

                        // If value has content
                        if (get().length>0)
                        {
                            price_it();
                            clear_prefix();
                            clear_suffix();
                        }

                    });

                };

                /**********************
                 * Remove price format *
                 ***********************/
                $.fn.unpriceFormat = function(){
                    return $(this).unbind(".price_format");
                };

                /******************
                 * Unmask Function *
                 *******************/
                $.fn.unmask = function(){

                    var field;
                    var result = "";

                    if($(this).is('input'))
                        field = $(this).val();
                    else
                        field = $(this).html();

                    for(var f in field)
                    {
                        if(!isNaN(field[f]) || field[f] == "-") result += field[f];
                    }

                    return result;
                };

            })(jQuery);

        </script>



        <script>$(document).ready(function(c) {
                $('.alert-close').on('click', function(c){
                    $('.message').fadeOut('slow', function(c){
                        $('.message').remove();
                    });
                });
            });
        </script>
        <script type="text/javascript">

            $(document).ready(function() {

                $('#Amount').priceFormat({
                    prefix: 'US$',
                    centsSeparator: '.',
                    thousandsSeparator: ','
                });
                $("#myform").on('click', '#btnsubmit', function() {

                    var hold = $('#Amount').unmask();
                    $("#Lite_Order_Amount").val(hold);
                    $("#Lite_Order_LineItems_Amount_1").val(hold);
                    console.log(hold);
                });


            });



        </script>
        <script>

            $(document).ready(function(e) {
                $('#btnsubmit').click(function() {
                    var sEmail = $('#txtEmail').val();

                    // Checking Empty Fields
                    if ($('#Amount').val() == 'US$0.00') {
                        $('#warning').text('All fields are mandatory');
                        event.preventDefault ? event.preventDefault() : event.returnValue = false;
                    }
                    else if (validateEmail(sEmail)) {
                        var eml = $("#txtEmail").val();
                        $('#Ecom_BillTo_Online_Email').val(eml);
                        $('#warning').text('');
                    }
                    else {
                        $('#warning').text('Invalid Email Address');
                        event.preventDefault ? event.preventDefault() : event.returnValue = false;
                    }
                });
            });
            // Function that validates email address through a regular expression.
            function validateEmail(sEmail) {
                var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
                if (filter.test(sEmail)) {
                    return true;
                }
                else {
                    return false;
                }
            }
        </script>



    <body>
    <!-- contact-form -->
    <div class="message warning">
        <div class="inset">
            <div class="login-head">
                <h1>Duluti Blessed Orphanage Donation</h1>

            </div>
            <form id="myform" name="myform" METHOD="POST" ACTION="https://merchantadmin.host.iveri.com/Lite/Transactions/New/EasyAuthorise.aspx">
                <!-- Mandatory form variables  -->
                <input id="Lite_Merchant_Applicationid" name="Lite_Merchant_Applicationid" type="hidden" value="{DCC36A97-AD8D-4316-BF76-241E1A4116AA}" readonly="true">
                <input id="Lite_Order_Amount" name="Lite_Order_Amount" type="hidden" value="0" readonly="true">
                <input type="hidden" name="Lite_Website_Successful_url" value="http://dulutiorphanage.org/donation/result.php" /> <!-- NEED TO BE CHANGED -->
                <input type="hidden" name="Lite_Website_Fail_url" value="http://dulutiorphanage.org/donation/result.php" /> <!-- NEED TO BE CHANGED -->
                <input type="hidden" name="Lite_Website_TryLater_url" value="http://dulutiorphanage.org/donation/result.php" /> <!-- NEED TO BE CHANGED -->
                <input type="hidden" name="Lite_Website_Error_url" value="http://dulutiorphanage.org/donation/result.php" /> <!-- NEED TO BE CHANGED -->
                <input id="Lite_Order_LineItems_Product_1" name="Lite_Order_LineItems_Product_1" type="hidden" value="Donation" readonly="true">
                <input id="Lite_Order_LineItems_Quantity_1" name="Lite_Order_LineItems_Quantity_1" type="hidden" value="1" readonly="true">
                <input id="Lite_Order_LineItems_Amount_1" name="Lite_Order_LineItems_Amount_1" type="hidden" value="0" readonly="true">
                <input id="Lite_ConsumerOrderID_PreFix" name="Lite_ConsumerOrderID_PreFix" type="hidden" value="DON" readonly="true">
                <input id="Ecom_BillTo_Online_Email" name="Ecom_BillTo_Online_Email" type="hidden" value="">
                <input id="Ecom_Payment_Card_Protocols" name="Ecom_Payment_Card_Protocols" type="hidden" value="iVeri" readonly="true">
                <input id="Ecom_ConsumerOrderID" name="Ecom_ConsumerOrderID" type="hidden" value="AUTOGENERATE">
                <input id="Ecom_TransactionComplete" name="Ecom_TransactionComplete" type="hidden" value="" readonly="true">
                <!-- End-->
                <font color="red"><p class="warningtext" id="warning" name="warning" >&nbsp;</p></font>
                <li>
                    <input type="text" autocomplete="off" id="txtEmail" name="txtEmail" class="text" value="Email Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email Address';}"><a href="#" class=" icon user" tabindex="-1" ></a>
                </li>
                <li>
                    <input type="text" id="Amount" name="Amount" class="text" value="0"><a href="#" class=" icon user" tabindex="-1"></a>
                </li>


                <div class="submit">
                    <input type="submit" id="btnsubmit" name="btnsubmit"  value="Proceed" >
                    <h4>Please enter your email address  <br>and amount to donate above</h4>
                    <div class="clear">  </div>
                </div>

            </form>
        </div>
    </div>
    </div>
    <div class="clear"> </div>
    <!--- footer --->
    <div class="footer">

    </div>
    </body>
</html>