jQuery('.testmonialsslider').slick({
  dots: false,
  infinite: false,
  speed: 500,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 7000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
})
.on('setPosition', function (event, slick) {
    slick.$slides.css('height', slick.$slideTrack.height() + 'px');
});



/*jQuery('.homeBnrSlider .cybernews-shortcode-container .csn-shortcode-news-container').slick({
  dots: false,
  infinite: true,
  speed: 500,
  slidesToShow: 5,
  slidesToScroll: 1,
  centerMode: true,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 7000
});*/


jQuery('.homeBnrSlider .cybernews-shortcode-container .csn-shortcode-news-container').slick({
  dots: false,
  infinite: true,
  speed: 500,
  slidesToShow: 5,
  slidesToScroll: 1,
  centerMode: true,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 7000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});


document.addEventListener("DOMContentLoaded", function () {
  const rowsOG = document.querySelectorAll(".newsPageList .cybernews-shortcode-container .csn-shortcode-news-container .csn-shortcode-news-item");
  const toggleButtonOG = document.getElementById("toggleOurNews");
  const initialRowsToShowOG = 18; // Show first 6 rows initially
  const rowsToShowOnClickOG = 18; // Show 8 more rows on each click
  let currentlyVisibleRowsOG = initialRowsToShowOG;

  // Initially show only the first 6 rows
  rowsOG.forEach((rowOG, index) => {
    rowOG.style.display = index < initialRowsToShowOG ? "" : "none";
  });

  // Hide the button if there are no more rows to show
  if (rowsOG.length <= initialRowsToShowOG) {
    toggleButtonOG.style.display = "none";
  }

  toggleButtonOG.addEventListener("click", function () {
    if (currentlyVisibleRowsOG >= rowsOG.length) {
      // Collapse to initial state
      rowsOG.forEach((rowOG, index) => {
        rowOG.style.display = index < initialRowsToShowOG ? "" : "none";
      });
      toggleButtonOG.textContent = "Show More";
      currentlyVisibleRowsOG = initialRowsToShowOG;
	  //alert(currentlyVisibleRows);
    } else {
      // Show the next set of rows
      const nextVisibleRowsOG = Math.min(currentlyVisibleRowsOG + rowsToShowOnClickOG, rowsOG.length);
      rowsOG.forEach((rowOG, index) => {
        rowOG.style.display = index < nextVisibleRowsOG ? "" : "none";
      });
      currentlyVisibleRowsOG = nextVisibleRowsOG;
	
	  
      // Update button text
      if (currentlyVisibleRowsOG >= rowsOG.length) {
        toggleButtonOG.textContent = "Show Less";
      }
    }
  });
});

