document.getElementById('t_ytVideoCover').onclick = function(){
    this.style.display = "none";
    var iframe = document.createElement('iframe');
    iframe.src = this.dataset.url;
    iframe.width = "482";
    iframe.height = "272";
    iframe.frameBorder = "0";
    iframe.allowFullscreen = "allowfullscrean";
    iframe.allow = "autoplay";
    this.parentElement.appendChild(iframe);
};