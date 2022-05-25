<!-- BEGIN: PAGE SCRIPTS -->
<!-- Google Map API -->
   <!--  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> -->


    <!-- Sparklines CDN -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>

    <!-- Chart Plugins -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/plugins/highcharts/highcharts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/plugins/circles/circles.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/plugins/raphael/raphael.js"></script>

    <!-- Holder js  -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/bootstrap/holder.min.js"></script>

    <!-- Theme Javascript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/utility/utility.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/main.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/demo.js"></script>

    <!-- Admin Panels  -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin-tools/admin-plugins/admin-panels/json2.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin-tools/admin-plugins/admin-panels/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin-tools/admin-plugins/admin-panels/adminpanels.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.js"></script>

    <!-- date picker -->

    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/plugins/daterange/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>

    <!-- Page Plugins -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/plugins/magnific/jquery.magnific-popup.js"></script>
    <!-- Admin Forms Javascript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/js/jquery-ui-monthpicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/js/jquery-ui-timepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/js/jquery-ui-touch-punch.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/js/jquery.spectrum.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/js/jquery.stepper.min.js"></script>

    <!-- jquery validation plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>


 <!-- daterangepicker -->
 <script type="text/javascript" src="<?php echo base_url(); ?>vendor/plugins/daterange/daterangepicker.js"></script>

   <!-- Page Javascript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/pages/widgets.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core      
            Core.init({
                sbm: "sb-l-c",
            });

            // Init Demo JS
            Demo.init();

            // Init Widget Demo JS
            // demoHighCharts.init();

            // Because we are using Admin Panels we use the OnFinish 
            // callback to activate the demoWidgets. It's smoother if
            // we let the panels be moved and organized before 
            // filling them with content from various plugins

            // Init plugins used on this page
            // HighCharts, JvectorMap, Admin Panels

            // Init Admin Panels on widgets inside the ".admin-panels" container
            $('.admin-panels').adminpanel({
                grid: '.admin-grid',
                draggable: true,
                mobile: true,
                callback: function() {
                    bootbox.confirm('<h3>A Custom Callback!</h3>', function() {});
                },
                onFinish: function() {
                    $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onLoad');

                    // Init the rest of the plugins now that the panels
                    // have had a chance to be moved and organized.
                    // It's less taxing to organize empty panels
                    demoHighCharts.init();
                    runVectorMaps();

                    // We also refresh any "in-view" waypoints to ensure
                    // the correct position is being calculated after the 
                    // Admin Panels plugin moved everything
                    Waypoint.refreshAll();

                },
                onSave: function() {
                    $(window).trigger('resize');
                }
            });

            // Widget VectorMap
            function runVectorMaps() {

                // Jvector Map Plugin
                var runJvectorMap = function() {
                    // Data set
                    var mapData = [900, 700, 350, 500];
                    // Init Jvector Map
                    $('#WidgetMap').vectorMap({
                        map: 'us_lcc_en',
                        //regionsSelectable: true,
                        backgroundColor: 'transparent',
                        series: {
                            markers: [{
                                attribute: 'r',
                                scale: [3, 7],
                                values: mapData
                            }]
                        },
                        regionStyle: {
                            initial: {
                                fill: '#E5E5E5'
                            },
                            hover: {
                                "fill-opacity": 0.3
                            }
                        },
                        markers: [{
                            latLng: [37.78, -122.41],
                            name: 'San Francisco,CA'
                        }, {
                            latLng: [36.73, -103.98],
                            name: 'Texas,TX'
                        }, {
                            latLng: [38.62, -90.19],
                            name: 'St. Louis,MO'
                        }, {
                            latLng: [40.67, -73.94],
                            name: 'New York City,NY'
                        }],
                        markerStyle: {
                            initial: {
                                fill: '#a288d5',
                                stroke: '#b49ae0',
                                "fill-opacity": 1,
                                "stroke-width": 10,
                                "stroke-opacity": 0.3,
                                r: 3
                            },
                            hover: {
                                stroke: 'black',
                                "stroke-width": 2
                            },
                            selected: {
                                fill: 'blue'
                            },
                            selectedHover: {}
                        },
                    });
                    // Manual code to alter the Vector map plugin to 
                    // allow for individual coloring of countries
                    var states = ['US-CA', 'US-TX', 'US-MO',
                        'US-NY'
                    ];
                    var colors = [bgWarningLr, bgPrimaryLr, bgInfoLr, bgAlertLr];
                    var colors2 = [bgWarning, bgPrimary, bgInfo, bgAlert];
                    $.each(states, function(i, e) {
                        $("#WidgetMap path[data-code=" + e + "]").css({
                            fill: colors[i]
                        });
                    });
                    $('#WidgetMap').find('.jvectormap-marker')
                        .each(function(i, e) {
                            $(e).css({
                                fill: colors2[i],
                                stroke: colors2[i]
                            });
                        });
                }

                if ($('#WidgetMap').length) {
                    runJvectorMap();
                }
            }
            // date of birth

        


          
        });



$(document).ready(function () {
      // Init daterange plugin
        $('#dob').datepicker({

            
        }); 

    });


$(document).ready(function () 
{
    $('#date_billed').datepicker({

    }); 
});

$(document).ready(function () 
{
    $('#expired_date').datepicker({

    }); 
});






// SUCCESS ALERT NOTIFICATION MESSAGE===> 

     function alertSuccessNotify(title,message){

            var Stacks = {
                stack_top_right: {
                    "dir1": "down",
                    "dir2": "left",
                    "push": "top",
                    "spacing1": 10,
                    "spacing2": 10
                },
            }

            // PNotify Plugin Event Init
                var noteStyle = "success";
                var noteShadow =true;
                var noteOpacity = 1;
                var noteStack ="stack_top_right";
                var width = "290px";

                new PNotify({
                    title: title,
                    text:  message,
                    shadow: noteShadow,
                    opacity: noteOpacity,
                    addclass: noteStack,
                    type: noteStyle,
                    stack: Stacks[noteStack],
                    width: "390px",
                    delay: 1400
                });

        }
// End SUCCESS ALERT NOTIFICATION MESSAGE===> 

// Error ALERT NOTIFICATION MESSAGE===> 

     function alertErrorNotify(title,message){

            var Stacks = {
                stack_top_right: {
                    "dir1": "down",
                    "dir2": "left",
                    "push": "top",
                    "spacing1": 10,
                    "spacing2": 10
                },
            }

            // PNotify Plugin Event Init
                var noteStyle = "danger";
                var noteShadow =true;
                var noteOpacity = 1;
                var noteStack ="stack_top_right";
                var width = "290px";

                new PNotify({
                    title: title,
                    text:  message,
                    shadow: noteShadow,
                    opacity: noteOpacity,
                    addclass: noteStack,
                    type: noteStyle,
                    stack: Stacks[noteStack],
                    width: "390px",
                    delay: 1400
                });

        }
// End Error ALERT NOTIFICATION MESSAGE===> 


// customer sucess mssg hiide=====>
// when we insert the customer sucess message hide after few second-->
$(document).ready(function() {
    var baseURl = '<?php echo base_url()?>';

$('.ui-pnotify').fadeOut(3000);
});


//end customer sucess mssg hiide=====>



// inline picker===========================>
$('#daterangepicker1').daterangepicker();
    $('#inline-daterange').daterangepicker(
        function(start, end) 
        {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

$('#datetimepicker1').datetimepicker();
// end inline picker===========================>
      

</script>



<!-- END: PAGE SCRIPTS -->


    

</body>

</html>
