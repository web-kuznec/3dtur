var windowPano = document.getElementsByClassName('window-pano')[0];
        var windowGoogle = document.querySelector('.window-pano .slide');
        if(windowPano && windowGoogle){
            windowPano.addEventListener('mousemove', function(event){
            windowGoogle.style.transition = "width .01s cubic-bezier(.22,.61,.36,1)";
            var p = event.layerX/windowPano.getBoundingClientRect().width*100;
            p = Math.max(7, Math.min(93, p))
            windowGoogle.style.width = p+'%';
          }, false)
            windowPano.addEventListener('mouseout', function(event){
            windowGoogle.style.transition = "width .8s cubic-bezier(.22,.61,.36,1)";
          }, false)
        }