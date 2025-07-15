 
        $(document).ready(function () {
            $('.project-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2500,
                dots: false,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: { slidesToShow: 2 }
                    },
                    {
                        breakpoint: 768,
                        settings: { slidesToShow: 1 }
                    }
                ]
            });
        });
    const counters = document.querySelectorAll('.counter');
  const speed = 100;

  counters.forEach(counter => {
    const updateCount = () => {
      const target = +counter.getAttribute('data-target');
      const count = +counter.innerText;

      const inc = target / speed;

      if (count < target) {
        counter.innerText = Math.ceil(count + inc);
        setTimeout(updateCount, 30);
      } else {
        counter.innerText = target;
      }
    };

    updateCount();
  });

  // this is for video banner

  
  function playVideo() {
    document.getElementById("videoFrame").style.display = "block";
    document.querySelector(".video-thumbnail").style.display = "none";
  }

  function closeVideo() {
    document.getElementById("videoFrame").style.display = "none";
    document.querySelector(".video-thumbnail").style.display = "block";
    const iframe = document.querySelector(".video-frame iframe");
    iframe.src = iframe.src; // stop video
  }

