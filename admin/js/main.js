(function ($) {
  "use strict";
  /*-------------------------------------
      Set Prefix
    -------------------------------------*/ 
 function getAge(birthDate, ageAtDate) {
    var daysInMonth = 30.436875; // Days in a month on average.
    var dob = new Date(birthDate);
    var aad;
    if (!ageAtDate) aad = new Date();
    else aad = new Date(ageAtDate);
    var yearAad = aad.getFullYear();
    var yearDob = dob.getFullYear();
    var years = yearAad - yearDob; // Get age in years.
    dob.setFullYear(yearAad); // Set birthday for this year.
    var aadMillis = aad.getTime();
    var dobMillis = dob.getTime();
    if (aadMillis < dobMillis) {
        --years;
        dob.setFullYear(yearAad - 1); // Set to previous year's birthday
        dobMillis = dob.getTime();
    }
    var days = (aadMillis - dobMillis) / 86400000;  
	
    var monthsDec = days / daysInMonth; // Months with remainder.
	console.log(years);
    var months = Math.floor(monthsDec); // Remove fraction from month.
    days = Math.floor(daysInMonth * (monthsDec - months));
    return  years+'Years/' + months+'Months/' + days+'Days' ;
}
 
 
 function getCurrentAge(birthDate) {
     var today = new Date();
    var birthDate = new Date(birthDate);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
   return age;
}
 
 
	
     $('#dob').blur(function(){
		 
	  var dobarray = $('#dob').val().split('/'); 
	  var dob = dobarray[1]+'/'+dobarray[0]+'/'+dobarray[2];
	  const d = new Date();
	  var month = d.getMonth();
	   var yr = 1900 + parseInt(d.getYear());
	  if(month>3)
	  {		  
	 
		var yr = yr +1 ;   
		  
	  }
	   var dtaetocalculate = "03/31/" + yr ;
	//  alert(dtaetocalculate);
	  var age =  getAge(dob,dtaetocalculate);; 
	 $('#AgeFeild').val(age);
}); 


$('#motherdob').blur(function(){
		 
	  var dobarray = $('#motherdob').val().split('/'); 
	  var dob = dobarray[1]+'/'+dobarray[0]+'/'+dobarray[2];	  
	  var age =  getCurrentAge(dob);; 
	 $('#motherage').val(age);
}); 


$('#fatherdob').blur(function(){
		 
	  var dobarray = $('#fatherdob').val().split('/'); 
	  var dob = dobarray[1]+'/'+dobarray[0]+'/'+dobarray[2];
	 var age =  getCurrentAge(dob);; 
	 $('#fatherage').val(age);
}); 


$('#guardiandob').blur(function(){
		 
	  var dobarray = $('#guardiandob').val().split('/'); 
	  var dob = dobarray[1]+'/'+dobarray[0]+'/'+dobarray[2];
	  var age =  getCurrentAge(dob);; 
	 $('#guardianage').val(age);
}); 




$("#copyaddress").click(function(){
         if(this.checked)
         {
             $("#paraddressline").val($("#addressline").val()); 
             $("#parhouseno").val($("#houseno").val()); 
             $("#parlocality").val($("#locality").val()); 
             $("#parcity").val($("#city").val()); 
             $("#parpincode").val($("#pincode").val()); 
             $("#parstateid").val($("#stateid").val()); 
             
         }
         else {
             $("#paraddressline").val('');
             $("#parhouseno").val('');
             $("#parlocality").val('');
             $("#parcity").val('');
             $("#parpincode").val('');
             $("#parstateid").val('');
         }
         });


  /*-------------------------------------
      Sidebar Toggle Menu
    -------------------------------------*/
	 $('#previousmedium').change(function () {
            if ($('#previousmedium').val() == 'Other') {
                $('#otherpreviousmedium').show();
				 $("#otherpreviousmediumtext").removeAttr("disabled", "disabled"); 
            }
            else {
                $('#otherpreviousmedium').hide();
				$("#otherpreviousmediumtext").attr("disabled", "disabled"); 
            }
        });
		 $('#previousboard').change(function () {
            if ($('#previousboard').val() == 'Other') {
                $('#otherpreviousboard').show();
				 $("#otherpreviousboardtext").removeAttr("disabled", "disabled"); 
            }
            else {
                $('#otherpreviousboard').hide();
				$("#otherpreviousboardtext").attr("disabled", "disabled"); 
            }
        });
     $('#admissioncategory').change(function () {
            if ($('#admissioncategory').val() == 'Other') {
                $('#otheradmissioncategory').show();
				 $("#otherotheradmissioncategorytext").removeAttr("disabled", "disabled"); 
            }
            else {
                $('#otheradmissioncategory').hide();
				$("#otherotheradmissioncategorytext").attr("disabled", "disabled"); 
            }
        });
		
		$('#categoryid').change(function () {
            if ($('#categoryid').val() == 'Other') {
                $('#othercategoryid').show();
				$("#otherothercategoryidtext").removeAttr("disabled", "disabled");
            }
            else {
                $('#othercategoryid').hide();
				$("#otherothercategoryidtext").attr("disabled", "disabled"); 
            }
        });
		
		$('#mothertongueid').change(function () { 
            if ($('#mothertongueid').val() == 'Other') {
                $('#othermothertounge').show();
				$("#othermothertoungetext").removeAttr("disabled", "disabled");
            }
            else {
                $('#othermothertounge').hide();
				$("#othermothertoungetext").attr("disabled", "disabled"); 
            }
        });
	 $("input[name='motheroccupation']").change(function () {
            if ($(this).val() == 'Working') {
                $('#motherprofessiondiv').show();
				// $("#otherpreviousmediumtext").removeAttr("disabled", "disabled"); 
            }
            else {
                $('#motherprofessiondiv').hide();
				//$("#otherpreviousmediumtext").attr("disabled", "disabled"); 
            }
        });	
		
	 $("input[name='fatheroccupation']").change(function () {
            if ($(this).val() == 'In service' || $(this).val() == 'Business') {
                $('#fatherprofessiondiv').show();
				// $("#otherpreviousmediumtext").removeAttr("disabled", "disabled"); 
            }
            else {
                $('#fatherprofessiondiv').hide();
				//$("#otherpreviousmediumtext").attr("disabled", "disabled"); 
            }
        });
		
	 $("input[name='guardianoccupation']").change(function () {
              if ($(this).val() == 'In service' || $(this).val() == 'Business') {
                $('#guardianprofessiondiv').show();
				// $("#otherpreviousmediumtext").removeAttr("disabled", "disabled"); 
            }
            else {
                $('#guardianprofessiondiv').hide();
				//$("#otherpreviousmediumtext").attr("disabled", "disabled"); 
            }
        });
	
  $('.sidebar-toggle-view').on('click', '.sidebar-nav-item .nav-link', function (e) {
    if (!$(this).parents('#wrapper').hasClass('sidebar-collapsed')) {
      var animationSpeed = 300,
        subMenuSelector = '.sub-group-menu',
        $this = $(this),
        checkElement = $this.next();
      if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
        checkElement.slideUp(animationSpeed, function () {
          checkElement.removeClass('menu-open');
        });
        checkElement.parent(".sidebar-nav-item").removeClass("active");
      } else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
        var parent = $this.parents('ul').first();
        var ul = parent.find('ul:visible').slideUp(animationSpeed);
        ul.removeClass('menu-open');
        var parent_li = $this.parent("li");
        checkElement.slideDown(animationSpeed, function () {
          checkElement.addClass('menu-open');
          parent.find('.sidebar-nav-item.active').removeClass('active');
          parent_li.addClass('active');
        });
      }
      if (checkElement.is(subMenuSelector)) {
        e.preventDefault();
      }
    } else {
      if ($(this).attr('href') === "#") {
        e.preventDefault();
      }
    }
  });

  /*-------------------------------------
      Sidebar Menu Control
    -------------------------------------*/
  $(".sidebar-toggle").on("click", function () {
    window.setTimeout(function () {
      $("#wrapper").toggleClass("sidebar-collapsed");
    }, 500);
  });

  /*-------------------------------------
      Sidebar Menu Control Mobile
    -------------------------------------*/
  $(".sidebar-toggle-mobile").on("click", function () {
    $("#wrapper").toggleClass("sidebar-collapsed-mobile");
    if ($("#wrapper").hasClass("sidebar-collapsed")) {
      $("#wrapper").removeClass("sidebar-collapsed");
    }
  });

  /*-------------------------------------
      jquery Scollup activation code
   -------------------------------------*/
  $.scrollUp({
    scrollText: '<i class="fa fa-angle-up"></i>',
    easingType: "linear",
    scrollSpeed: 900,
    animation: "fade"
  });

  /*-------------------------------------
      jquery Scollup activation code
    -------------------------------------*/
  $("#preloader").fadeOut("slow", function () {
    $(this).remove();
  });

  $(function () {
    /*-------------------------------------
          Data Table init
      -------------------------------------*/
   if ($.fn.DataTable !== undefined) {
      $('.data-table').DataTable({
        paging: true,
        searching: true,
        info: true,
        lengthChange: true,
        lengthMenu: [20, 50, 75, 100],
        order: [[0]],
        columnDefs: [{
          targets: [0, -1], // column or columns numbers
          orderable: true // set orderable for selected columns
        }],
      });
    }

    /*-------------------------------------
          All Checkbox Checked
      -------------------------------------*/
    $(".checkAll").on("click", function () {
      $(this).parents('.table').find('input:checkbox').prop('checked', this.checked);
    });

    /*-------------------------------------
          Tooltip init
      -------------------------------------*/
    $('[data-toggle="tooltip"]').tooltip();

    /*-------------------------------------
          Select 2 Init
      -------------------------------------*/
    if ($.fn.select2 !== undefined) {
      $('.select2').select2({
        width: '100%'
      });
    }

    /*-------------------------------------
          Date Picker
      -------------------------------------*/
    if ($.fn.datepicker !== undefined) {
      $('.air-datepicker').datepicker({
        language: {
          days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
          daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
          daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          today: 'Today',
          clear: 'Clear',
          dateFormat: 'dd/mm/yyyy',
		  autoClose: 'true',
          firstDay: 0
        }
      });
    }
	//$.fn.datepicker.defaults.autoclose = true;


    /*-------------------------------------
          Counter
      -------------------------------------*/
    var counterContainer = $(".counter");
    if (counterContainer.length) {
      counterContainer.counterUp({
        delay: 50,
        time: 1000
      });
    }

    /*-------------------------------------
          Vector Map 
      -------------------------------------*/
    if ($.fn.vectorMap !== undefined) {
      $('#world-map').vectorMap({
        map: 'world_mill',
        zoomButtons: false,
        backgroundColor: 'transparent',

        regionStyle: {
          initial: {
            fill: '#0070ba'
          }
        },
        focusOn: {
          x: 0,
          y: 0,
          scale: 1
        },
        series: {
          regions: [{
            values: {
              CA: '#41dfce',
              RU: '#f50056',
              US: '#f50056',
              IT: '#f50056',
              AU: '#fbd348'
            }
          }]
        }
      });
    }

    /*-------------------------------------
          Line Chart 
      -------------------------------------*/
    if ($("#earning-line-chart").length) {

      var lineChartData = {
        labels: ["", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun", ""],
        datasets: [{
            data: [0, 5e4, 1e4, 5e4, 14e3, 7e4, 5e4, 75e3, 5e4],
            backgroundColor: '#ff0000',
            borderColor: '#ff0000',
            borderWidth: 1,
            pointRadius: 0,
            pointBackgroundColor: '#ff0000',
            pointBorderColor: '#ffffff',
            pointHoverRadius: 6,
            pointHoverBorderWidth: 3,
            fill: 'origin',
            label: "Total Collection"
          },
          {
            data: [0, 3e4, 2e4, 6e4, 7e4, 5e4, 5e4, 9e4, 8e4],
            backgroundColor: '#417dfc',
            borderColor: '#417dfc',
            borderWidth: 1,
            pointRadius: 0,
            pointBackgroundColor: '#304ffe',
            pointBorderColor: '#ffffff',
            pointHoverRadius: 6,
            pointHoverBorderWidth: 3,
            fill: 'origin',
            label: "Fees Collection"
          }
        ]
      };
      var lineChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 2000
        },
        scales: {

          xAxes: [{
            display: true,
            ticks: {
              display: true,
              fontColor: "#222222",
              fontSize: 16,
              padding: 20
            },
            gridLines: {
              display: true,
              drawBorder: true,
              color: '#cccccc',
              borderDash: [5, 5]
            }
          }],
          yAxes: [{
            display: true,
            ticks: {
              display: true,
              autoSkip: true,
              maxRotation: 0,
              fontColor: "#646464",
              fontSize: 16,
              stepSize: 25000,
              padding: 20,
              callback: function (value) {
                var ranges = [{
                    divider: 1e6,
                    suffix: 'M'
                  },
                  {
                    divider: 1e3,
                    suffix: 'k'
                  }
                ];

                function formatNumber(n) {
                  for (var i = 0; i < ranges.length; i++) {
                    if (n >= ranges[i].divider) {
                      return (n / ranges[i].divider).toString() + ranges[i].suffix;
                    }
                  }
                  return n;
                }
                return formatNumber(value);
              }
            },
            gridLines: {
              display: true,
              drawBorder: false,
              color: '#cccccc',
              borderDash: [5, 5],
              zeroLineBorderDash: [5, 5],
            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          mode: 'index',
          intersect: false,
          enabled: true
        },
        elements: {
          line: {
            tension: .35
          },
          point: {
            pointStyle: 'circle'
          }
        }
      };
      var earningCanvas = $("#earning-line-chart").get(0).getContext("2d");
      var earningChart = new Chart(earningCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      });
    }

$(".alert-dismissible").fadeTo(3000, 500).slideUp(500, function(){
	$.ajax({ 
			type:'GET', 
			url:'unset_var.php' 
		}); 

    $(".alert-dismissible").slideUp(500);
});


    /*-------------------------------------
          Bar Chart 
      -------------------------------------*/
    if ($("#expense-bar-chart").length) {

      var barChartData = {
        labels: ["Jan", "Feb", "Mar"],
        datasets: [{
          backgroundColor: ["#40dfcd", "#417dfc", "#ffaa01"],
          data: [125000, 100000, 75000, 50000, 150000],
          label: "Expenses (millions)"
        }, ]
      };
      var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 2000
        },
        scales: {

          xAxes: [{
            display: false,
            maxBarThickness: 100,
            ticks: {
              display: false,
              padding: 0,
              fontColor: "#646464",
              fontSize: 14,
            },
            gridLines: {
              display: true,
              color: '#e1e1e1',
            }
          }],
          yAxes: [{
            display: true,
            ticks: {
              display: true,
              autoSkip: false,
              fontColor: "#646464",
              fontSize: 14,
              stepSize: 25000,
              padding: 20,
              beginAtZero: true,
              callback: function (value) {
                var ranges = [{
                    divider: 1e6,
                    suffix: 'M'
                  },
                  {
                    divider: 1e3,
                    suffix: 'k'
                  }
                ];

                function formatNumber(n) {
                  for (var i = 0; i < ranges.length; i++) {
                    if (n >= ranges[i].divider) {
                      return (n / ranges[i].divider).toString() + ranges[i].suffix;
                    }
                  }
                  return n;
                }
                return formatNumber(value);
              }
            },
            gridLines: {
              display: true,
              drawBorder: true,
              color: '#e1e1e1',
              zeroLineColor: '#e1e1e1'

            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {}
      };
      var expenseCanvas = $("#expense-bar-chart").get(0).getContext("2d");
      var expenseChart = new Chart(expenseCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      });
    }

    /*-------------------------------------
          Doughnut Chart 
      -------------------------------------*/
    if ($("#student-doughnut-chart").length) {

      var doughnutChartData = {
        labels: ["Female Students", "Male Students"],
        datasets: [{
          backgroundColor: ["#304ffe", "#ffa601"],
          data: [45000, 105000],
          label: "Total Students"
        }, ]
      };
      var doughnutChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 65,
        rotation: -9.4,
        animation: {
          duration: 2000
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
      };
      var studentCanvas = $("#student-doughnut-chart").get(0).getContext("2d");
      var studentChart = new Chart(studentCanvas, {
        type: 'doughnut',
        data: doughnutChartData,
        options: doughnutChartOptions
      });
    }

    /*-------------------------------------
          Calender initiate 
      -------------------------------------*/
    if ($.fn.fullCalendar !== undefined) {
      $('#fc-calender').fullCalendar({
        header: {
          center: 'basicDay,basicWeek,month',
          left: 'title',
          right: 'prev,next',
        },
        fixedWeekCount: false,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        aspectRatio: 1.8,
        events: [{
            title: 'All Day Event',
            start: '2019-04-01'
          },

          {
            title: 'Meeting',
            start: '2019-04-12T14:30:00'
          },
          {
            title: 'Happy Hour',
            start: '2019-04-15T17:30:00'
          },
          {
            title: 'Birthday Party',
            start: '2019-04-20T07:00:00'
          }
        ]
      });
    }
  });

})(jQuery);
$('#validateform').validate({
  rules : {
        'selector[]': { required: true, minlength: 1 }
  }
  ,
	messages: {
		'selector[]': "*Select at least 1 checkbox" 
	},
	errorElement : 'div',
    errorLabelContainer: '.errorTxt',errorPlacement:
function( error, element ){
if(element.is( ":checkbox" )){
// error append here
error.appendTo('.tablehead');
}
else {
error.insertAfter(element);
}
}
});
$( ".resetform" ).click(function() {
 window.location.reload();
});
 
jQuery('#updatepassword').validate({
	rules:{
		Password:
		{
			minlength : 6,
			pwcheck: true
		},
		ConfirmPassword:
		{
			minlength : 6,
			equalTo : "#password"
		}
		},
		messages:
		{
			password:
			{
				required: "Password Required",
				pwcheck: "Password Not Matched"
            }
         }
}); 


 jQuery('#formwithmobile').validate({
	rules:{
		 mobile: {
        phoneUS: true
    } 
		} 
});

jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 && 
    phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please Enter a valid phone number");