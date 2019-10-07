// Flickity Carousel
(function callCarousel() {

    var carousel = document.querySelector('.carousel');
    var flkty = new Flickity( carousel, {
      imagesLoaded: true,
      percentPosition: false,
      cellAlign: 'center',
      pageDots: false,
      arrowShape: 'M 0,50 L 60,00 L 50,30 L 80,30 L 80,70 L 50,70 L 60,100 Z',
    });
    
    var imgs = carousel.querySelectorAll('.carousel-cell img');
    // get transform property
    var docStyle = document.documentElement.style;
    var transformProp = typeof docStyle.transform == 'string' ?
      'transform' : 'WebkitTransform';
    
    flkty.on( 'scroll', function() {
      flkty.slides.forEach( function( slide, i ) {
        var img = imgs[i];
        var x = ( slide.target + flkty.x ) * -1/3;
        img.style[ transformProp ] = 'translateX(' + x  + 'px)';
      });
    });
    
    })();