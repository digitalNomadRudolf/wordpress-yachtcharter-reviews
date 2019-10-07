;(function(window) {
    'use strict';

    var document = window.document,
    docElem = document.documentElement;

    function extend(a, b) {
        for( var key in b) {
            if(b.hasOwnProperty(key)) {
                a[key] = b[key];
            }
        }
        return a;
    }

    // from https://github.com/ryanve/response.js/blob/master/response.js
    function getViewportH() {
        var client = docElem['clientHeight'],
        inner = window['innerHeight'];
        if(client < inner) {
            return inner;
        } else {
            return client;
        }
    }

    // http://stackoverflow.com/a/11396681/989439  / retrieve the position (x and y) of an element
    function getOffset(el) {
        return el.getBoundingClientRect();
    }

    // http://snipplr.com/view.php?codeview&id=5259
    // this function determines whether the event is the equivalent of the microsoft 
    // mouseleave or mouseenter events
    function isMouseLeaveOrEnter(e, handler) {
        if (e.type != 'mouseout' && e.type != 'mouseover') return false;
        var reltg = e.relatedTarget ? e.relatedTarget : e.type == 'mouseout' ? e.toElement : e.fromElement; 
    // The event.relatedTarget property returns which element being entered or exited on mouse movement.
    // fromElement and toElement are IE non-standard ways to obtain the relatedTarget
        while(reltg && reltg != handler) reltg = reltg.parentNode;
        return (reltg != handler);
    }

    function cbpTooltipMenu(el, options) {
        this.el = el;
        this.options = extend(this.defaults, options);
        this._init();
    }

    cbpTooltipMenu.prototype = {
        defaults : {
            // add a timeout to avoid the menu to open instantly
            delayMenu : 100
        },
        _init : function() {
            this.touch = Modernizr.touch;
            this.menuItems = document.querySelectorAll( '#' + this.el.id + ' > li ' );
            this._initEvents();
        },
        _initEvents : function() {
            var self = this;
            // Essentially what we are doing is using the slice method that all arrays have and then coercing it to work with an object using “call”. 
            // “Call” — and “apply” — allow us to redirect the “this” property from one object to another.
            Array.prototype.slice.call(this.menuItems).forEach(function(el, i) {
                var trigger = el.querySelector('a');
                if(self.touch) {
            // if Modernizr.touch > when the linked is clicked, call the handleClick method that takes this and ev(event)
                    trigger.addEventListener('click', function(ev) {
                        self._handleClick(this, ev); });
                    } else {
            // when link is clicked get the parent  node of the element with the class of menu-sub inside of the ul.  preventDefault to prevent the page from refreshing/ loading. 
                        trigger.addEventListener('click', function(ev) {
                            if(this.parentNode.querySelector('ul.menu-sub')) {
                                ev.preventDefault();
                            }
                        });
                        //when mouse over element, callback function takes event and IF its equivalent of microsoft mouseover or mouseout THEN call the this.openMenu and closeMenu
                        el.addEventListener('mouseover', function(ev) {
                            if(isMouseLeaveOrEnter(ev, this)) self._openMenu(this); });
                        el.addEventListener('mouseout', function(ev) {
                            if(isMouseLeaveOrEnter(ev, this)) self._closeMenu(this); });
                    }
                });
        },
        _openMenu : function(el) {
            var self = this;
            clearTimeout(this.omtimeout);
            this.omtimeout = setTimeout(function() {
                var submenu = el.querySelector('ul.menu-sub');

                if(submenu) {
                    el.className = 'menu-show';
                    if(self._positionMenu(el) === 'top') {
                        el.className += ' menu-show-above';
                    } else {
                        el.className += ' menu-show-below';
                    }
                }
            }, this.touch ? 0 : this.options.delayMenu);
        },
        _closeMenu : function(el) {
            clearTimeout(this.omtimeout);

            var submenu = el.querySelector('ul.menu-sub');
            if (submenu) {
                // based on https://github.com/desandro/classie/blob/master/classie.js
                el.className = el.className.replace(new RegExp("(^|\\s+)" + "menu-show" + "(\\s+|$)"), ' ');
                el.className = el.className.replace(new RegExp("(^|\\s+)" + "menu-show-below" + "(\\s+|$)"), ' ');
                el.className = el.className.replace(new RegExp("(^|\\s+)" + "menu-show-above" + "(\\s+|$)"), ' ');
            }

        },
        _handleClick : function(el, ev) {
            var item = el.parentNode,
            items = Array.prototype.slice.call(this.menuItems),
            submenu = item.querySelector('ul.menu-sub')


            // first close any opened one
            if(this.current && items.indexOf(item) !== this.current) {
                this._closeMenu(this.el.children[this.current]);
                this.el.children[this.current].querySelector('ul.menu-sub').setAttribute('data-open', 'false');
            }
            if(submenu) {
                ev.preventDefault();

                var isOpen = submenu.getAttribute('data-open');
                if(isOpen === 'true') {
                    this._closeMenu(item);
                    submenu.setAttribute('data-open', 'false');
                } else {
                    this._openMenu(item);
                    this.current = items.indexOf(item);
                    submenu.setAttribute('data-open', 'true');
                }
            }
        },
        _positionMenu : function(el) {
            // checking where's more space left in the viewport: above or below the element
            var vH = getViewportH(),
            ot = getOffset(el),
            spaceUp = ot.top,
            spaceDown = vH - spaceUp - el.offsetHeight;

            return(spaceDown <= spaceUp ? 'top' : 'bottom');
         }
    }

    // add to global namespace
    window.cbpTooltipMenu = cbpTooltipMenu;

} )(window);


// pin the nav to the top of the viewport when it scrolls past the top
(function stickyNav($) {
    $(document).ready(function(){
    var stickNavi = $('.menu').offset().top;

    $(window).scroll(function(){
        if ($(window).scrollTop() > stickNavi && ($('.menu').is('subpage-menu'))) {
            $('#subpage-menu').css("top", "0");
        }
        else if ($(window).scrollTop() > stickNavi && ($(window).width() > 710)) {
            $('.menu').addClass('pin-nav');
        } else {
            $('.menu').removeClass('pin-nav');
        }
    });
});
    

})(jQuery);

