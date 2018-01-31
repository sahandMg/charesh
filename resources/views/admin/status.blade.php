<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Users status</title>



      <link rel="stylesheet" href="{{URL::asset('CSS/style.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>



  <div class="row" style="margin:auto">
      <ul  class="nav nav-tabs">
          <li><a href="{{route('contents')}}">تصاویر کاربران</a></li>
          <li><a href="{{route('matchImg')}}">تصاویر مسابقات</a></li>
          <li><a href="{{route('text')}}">متن مسابقات</a></li>
          <li ><a href="{{route('orgImg')}}">تصاویر برگزار کنندگان</a></li>
          <li><a href="{{route('orgText')}}">متن های برگزار کننده</a></li>
          <li  ><a href="{{route('canceled')}}">مسابقات کنسل شده</a></li>
          <li class="active" ><a href="{{route('barGraph')}}">وضعیت اعضای سایت</a></li>
          <li><a href="{{route('payment')}}">تسویه حساب  </a></li>
          <li><a href="{{route('home')}}">خانه</a></li>
      </ul>
  </div>

  <br>

  <h2 style="text-align: center">وضعیت اعضای سایت </h2>
  <br>
  <div style="margin: auto" id="bargraph"></div>



  <h4 style="text-align: center"><a href="{{route('moreInfo')}}">اطلاعات بیشتر</a></h4>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://d3js.org/d3.v3.min.js'></script>




    <script type="text/javascript">

var parentDiv = [];
var descriptor = '';
var runOnce = [];

// get content of .bar .node span

// put content of span in .descriptor

var dataset1 = {'کل کاربران سایت':{!! $allUsers !!} ,'کاربران آنلاین': {!! count($onlineUsers) !!}, 'مهمان' :  {!! $Guests !!}};




	function drawGraph(parent, dataset, desc, axis, axisize, yaxisLabel, xAxisLabelText, yAxisLabelText) {
		//Width height and margin


    var margin = {
				top: 0,
				right: 0,
				bottom: 0,
				left: 0
			},
			w = ewidth;
	var h = 200 - margin.top - margin.bottom;
	  var barPadding = 10;
    var ymargin;

		if (axis === 'y') {
		} else {
		  axisize = 0;
		}
     if (yaxisLabel === 'y') {
          var axisLabel = 20;
          ymargin = "20";
     } else {
          var axisLabel = 0;
         ymargin = 0;
     }


   	w = w - axisize - axisLabel - ymargin;
		// checking the largest value of array and basing all bar height off it
		// essentially setting max value as 100% of graph height etc
		var mathArray = [];
		var dataset = dataset;

		$.each(dataset, function(key, value) {
			mathArray.push(value);
		});

		var maxVal = Math.max.apply(Math, mathArray);
		var minVal = 0;

		var pixMax = h / maxVal;
		var data = [];
		$.each(mathArray, function(key, value) {
			data[key] = Math.round(value * pixMax);
		});
		var numLen = mathArray.length;
		//Create SVG element
		var svg = d3.select(parent)
			.style("width", w)
			.style("height", h + "px")
			.style("display", "block")
        .style("margin-left", ymargin + "px")
			.style("position", "relative");



    if (yaxisLabel === 'y') {
			var yaxisLabel = svg
				.append('span')
				.attr('class', 'qgSBG-ylabel')
				.html(yAxisLabelText);
		}


		if (axis === 'y') {
			var yaxis = svg
				.append("span")
				.attr("class", "qgSBG-yaxis")
				.style("height", h + "px")
				.style("width", axisize - 20 + "px");
			yaxis
				.append('span')
				.attr('class', 'qgSBG-yMax')
				.html(maxVal);
			yaxis
				.append('span')
				.attr('class', 'qgSBG-yMin')
				.html(minVal);
			yaxis
				.append("span")
				.attr("class", "qgSBG-yaxisBar")
				.style("height", h - 2 + "px")
				.style("width", 5 + "px")
				.style("left", axisize - 12 + "px");
		}




		var bar = svg.selectAll("div")
			.data(data)
			.enter()
			.append("div")
			.attr("class", "bar")
			.style("overflow", "hidden")
			.style("margin-left", function(d, i) {

				var marginScaler = 1;
				if (numLen < 4) {
					marginScaler = .6;
				}
				if (numLen < 3) {
					marginScaler = .4;
				}


				// padding and width set by 3/4 width bars, 1/4 padding and 1/8 offset to center bars
				// axisize is how much room for the axis text - offsets the graph by required amount - set in init
				// init('bargraph', dataset1, 'visitors', 'y', 150); <-- the 150 would make the graph offset by 150
				// and the y turns it on, if y isn't set, it wont load and will default to 0 and the graph will be
				// full width with no axis

				return ((((w / (numLen)) * i) + (1 / 8 * w / numLen)) * marginScaler) + axisize + "px";

			})
			.style("width", function(d, i) {
				var widthScaler = 1;
				if (numLen < 4) {
					widthScaler = .6;
				}
				if (numLen < 3) {
					widthScaler = .4;
				}
				return (3 / 4 * w / numLen) * widthScaler + "px";

			})
			.style("height", h + "px")

		.append("div")
			.attr("class", function(d) {
				if (runOnce[$(parent).attr('id')] === false) {
					return 'node';
				} else {
					return 'node qgSBC-colour';
				}
			})
			.attr("margin-data", function(d) {
				return (h + margin.top - d) + 1 + "px";
				//return h + "px";
			})
			.style("width", function(d, i) {
				return 3 / 4 * w / numLen + "px";
			})
			.style("margin-top", function(d) {
				if (runOnce[$(parent).attr('id')] === false) {
					return h + "px";
				} else {
					return (h + margin.top - d) + 1 + "px";
				}
			})
			.append("div")
			.insert("span")
			.html(function(d, j) {
				var spanText = [];
				var num = j;
				//.console.log(dataset[j]);
				//spanText= dataset[i];
				$.each(dataset, function(key, value) {
					spanText.push('<strong>' + key + '</strong>: <span class="qgSBS-barval">' + value + '</span> ' + desc);
				})
				//.console.log('span text:' + spanText);
				return spanText[num];
			});

     xAxisLabelText = '<strong>' + xAxisLabelText + '</strong>';

		loader(parentDiv, desc, xAxisLabelText);
		// load animation
		if (runOnce[$(parent).attr('id')] === false) {
			animBars($(parent).attr('id'));
			runOnce[$(parent).attr('id')] = true;
		}
	}

	function animBars(parentDiv) {
	  var blam;
		$('#' + parentDiv + ' .node').each(function(i) {
      blam = $(this).attr('margin-data');
      var delay = 100 + i * 100;
      var thisThing = $(this);
      $(this).delay(delay).animate({
        marginTop: blam,
        easing: 'swing'
      }, 1000);
      function classItUp(){
        $(thisThing).attr('class', 'node qgSBC-colour');
      }
      setTimeout(classItUp, delay + 200);


      i++;
		});
	}

function setSize(parent, dataset, desc, axis, axisize, axisLabel, xAxisLabelText, yAxisLabelText) {
		// setting a min width on the graph, you don't want it dissapearing...

		ewidth = parent.clientWidth;
		if (axisize) {
			if (parent.clientWidth < (axisize + 150)) {
				ewidth = axisize + 150;
			}
		} else if (parent.clientWidth < 150) {
			ewidth = axisize + 150;
		}
		var eheight = parent.clientHeight;

		$(parent).empty();
		$('<style>.svg-wrapper.hover .shape {stroke-dasharray: ' + (ewidth + 16) + 'px;   stroke-dashoffset:  ' + (ewidth + 16) + 'px;}</style>').appendTo(parent);
		drawGraph(parent, dataset, desc, axis, axisize, axisLabel, xAxisLabelText, yAxisLabelText);
	}

	function init(parent, dataset, desc, axis, axisize, axisLabel, xAxisLabelText, yAxisLabelText) {


     runOnce[parent] = false;
		var elemD = document.getElementById(parent);
		parentDiv.push(parent);
		$(elemD).wrap('<div class="wrap ' + parent + ' "></div>');
		//$('<div class="descriptor" style="width: 100%;"></div>').insertBefore(elemD);
		$('<div class="svg-wrapper"><svg height="25" width="100%" xmlns="http://www.w3.org/2000/svg"><rect class="shape" height="25" width="100%" /><div class="descriptor text"><div class="xAxisTitle">' + xAxisLabelText + '</div><div class="bartext"></div></div></svg></div>').insertAfter(elemD);
		setSize(elemD, dataset, desc, axis, axisize, axisLabel, xAxisLabelText, yAxisLabelText);

		var that = this;
		var currentHeight;
		var currentWidth;

		$(window).resize(function() {
			var windowHeight = $(window).height();
			var windowWidth = $(window).width();
			if (currentHeight == undefined || currentHeight != windowHeight || currentWidth == undefined || currentWidth != windowWidth) {
				// redraw the chart here will make IE8 fire resize event again
				currentHeight = windowHeight;
				currentWidth = windowWidth;
				that.setSize(elemD, dataset, desc, axis, axisize, axisLabel, xAxisLabelText, yAxisLabelText);
			}
		});

	}


	function loader(parent, desc, xAxisLabelText) {
   var test;

		$(".bar").mouseover(function( event ) {

			$.each(parent, function(key, value) {

				if ($(event.target).parents('#' + value).parent().hasClass(value)) {
					var text_val = $(event.target).find('span').html();
					var target = '.' + value + ' .descriptor .bartext';
					var target2 = '.' + value + ' .descriptor .xAxisTitle';
					$(target).html(text_val);
          $(target2).hide();
					$(target).closest('.svg-wrapper').addClass('hover');
				}
			})
		});
		$(".bar").mouseout(function() {
  	    $(this).closest('.wrap').find('.descriptor .bartext').html('');
  	    $(this).closest('.wrap').find('.descriptor .xAxisTitle').show();

        $('.svg-wrapper').removeClass('hover');
		});



		$(".bar").click(function() {

			$.each(parent, function(key, value) {

				if ($(event.target).parents('#' + value).parent().hasClass(value)) {
					var text_val = $(event.target).find('span').html();
					//.console.log(text_val);
					var target = '.' + value + ' .descriptor';
					$(target).html(text_val);
				}

			})
		});
	}

// init(targetid, dataArrayName, descriptor, YAxisLabel(y/n), YAxisWidth(px implied), XAxisLabel, YAxisLabel);
init('bargraph', dataset1, ' ', 'y', 80, 'y', ' ', 'کاربران');


/*  will probably change the inits to something more along the lines of below - additionally will be changing this to pull the data out of tables or other options

  init({
    divID       : 'bargraph', // id (the target id of graph output - should be an empty div with an ID)
    dataTableID : 'dataset1', // id on table (warning: currently set to data array in above code not table - change pending)
    descriptor  : 'visitors', // text
    yAxis : 'y', // y/n - (Display Y axis values)
    yAxisLabel : 'y', // y/n
    yAxisLabelText: 'Y axis title text', // text
    yAxisWidth: '80', // number value of pixels - eg. "80" but not "80px" (set here for graph width calcs)
    xAxis : '',                // currently not available
    xAxisLabel : '',           // not required
    xAxisLabelText: ''         // currently not available
  });
*/
</script>

</body>
</html>
