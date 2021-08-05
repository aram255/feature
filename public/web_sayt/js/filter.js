

// Heart Active--------------------------------------
$('.person__info-heart').click(function () {
   $('.person__info-heart').toggleClass('active');
});

// Video---------------------------------------------

$(document).on('click', '.js-videoPoster', function (e) {
   e.preventDefault();
   let poster = $(this);
   let wrapper = poster.closest('.js-videoWrapper');
   videoPlay(wrapper);
});

function videoPlay(wrapper) {
   let iframe = wrapper.find('.js-videoIframe');
   let src = iframe.data('src');
   wrapper.addClass('videoWrapperActive');
   iframe.attr('src', src);
}

// Calendar-----------------------------------------

// function generate_year_range(start, end) {
//    let years = "";
//    for (let year = start; year <= end; year++) {
//       years += "<option value='" + year + "'>" + year + "</option>";
//    }
//    return years;
// }

// let today = new Date();
// let currentMonth = today.getMonth();
// let currentYear = today.getFullYear();
// let selectYear = document.getElementById("year");
// let selectMonth = document.getElementById("month");
//
//
// let createYear = generate_year_range(1970, 2050);
/** or
 * createYear = generate_year_range( 1970, currentYear );
 */

// document.getElementById("year").innerHTML = createYear;

// let calendar = document.getElementById("calendar");
// let lang = calendar.getAttribute('data-lang');
//
// let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
// let days = ["S", "M", "T", "W", "T", "F", "S"];
//
// let dayHeader = "<tr>";
// for (day in days) {
//    dayHeader += "<th data-days='" + days[day] + "'>" + days[day] + "</th>";
// }
// dayHeader += "</tr>";

// document.getElementById("thead-month").innerHTML = dayHeader;
//
//
// monthAndYear = document.getElementById("monthAndYear");
// showCalendar(currentMonth, currentYear);
//
//
//
// function next() {
//    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
//    currentMonth = (currentMonth + 1) % 12;
//    showCalendar(currentMonth, currentYear);
// }
//
// function previous() {
//    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
//    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
//    showCalendar(currentMonth, currentYear);
// }


// function showCalendar(month, year) {
//
//    let firstDay = (new Date(year, month)).getDay();
//
//    tbl = document.getElementById("calendar-body");
//
//    //
//    // tbl.innerHTML = "";
//    //
//    //
//    // monthAndYear.innerHTML = months[month];
//    selectYear.value = year;
//    selectMonth.value = month;
//
//    // creating all cells
//    let date = 1;
//    for (let i = 0; i < 6; i++) {
//       let row = document.createElement("tr");
//
//       for (let j = 0; j < 7; j++) {
//          if (i === 0 && j < firstDay) {
//             cell = document.createElement("td");
//             cellText = document.createTextNode("");
//             cell.appendChild(cellText);
//             row.appendChild(cell);
//          } else if (date > daysInMonth(month, year)) {
//             break;
//          } else {
//             cell = document.createElement("td");
//             cell.setAttribute("data-date", date);
//             cell.setAttribute("data-month", month + 1);
//             cell.setAttribute("data-year", year);
//             cell.setAttribute("data-month_name", months[month]);
//             cell.className = "date-picker";
//             cell.innerHTML = "<span>" + date + "</span>";
//
//             if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
//                cell.className = "date-picker selected";
//             }
//             row.appendChild(cell);
//             date++;
//          }
//
//
//       }
//
//       tbl.appendChild(row);
//    }
//
// }

// function daysInMonth(iMonth, iYear) {
//    return 32 - new Date(iYear, iMonth, 32).getDate();
// }

// Video Intro Calendar nav

let clickVideo = document.querySelector(".person__content");

clickVideo.onclick = function (event) {
   let target = event.target
   if (target.innerHTML === 'Video') {
      target.classList.add('active')

   }
}

$('.person__content-nav-category').click(function (event) {
   $('.person__content-nav-category').removeClass('active');
   $(this).addClass('active');
   console.log(this.innerHTML)
   if (this.innerHTML === 'Video') {
      $('.person__content-video').removeClass('ds-none')
      $('.person__content-intro').addClass('ds-none')
      // $('.person__content-calendar').addClass('ds-none')
      $('.person__content-maps').addClass('ds-none')

   } else if (this.innerHTML === 'Intro') {
      $('.person__content-video').addClass('ds-none')
      $('.person__content-intro').removeClass('ds-none')
      // $('.person__content-calendar').addClass('ds-none')
       $('.person__content-maps').addClass('ds-none')

   }  else{

       $('.person__content-video').addClass('ds-none')
       $('.person__content-intro').addClass('ds-none')
       // $('.person__content-calendar').addClass('ds-none')
       $('.person__content-maps').removeClass('ds-none')
   }

});


//  Filer Mobile Click
//
// let but = document.getElementById("filter-but")
// but.addEventListener('click', f)
//
// function f() {
//    // let filter_form = document.getElementsByClassName('filter')[0]
//    // filter_form.style.top = '0';
//    // filter_form.style.zIndex = '999'
//    // filter_form.style.transition = 'all 2s'
// }
