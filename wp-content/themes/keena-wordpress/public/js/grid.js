window.grid = {
    'temp': {},
    'flags': [],
    'css': `
        #grid {position:fixed; top:0; right:0; bottom:0; left:0; height:100%; z-index:2147483647; pointer-events:none; opacity:1; transition:opacity 0.33s ease-in-out;}
        #grid.hide-grid {opacity:0;}
        #grid_cols {margin:0 auto; padding:0 ZZpx; height:100%;}
        #grid_cols div {float:left; margin-left:ZZpx; width:calc((100% - (ZZpx)*11)/12); height:100%; border-left:1px solid #0f0; border-right:1px solid rgba(0,255,0,0.90); background:rgba(0,255,0,0.45);}
        #grid_cols div:first-child {margin-left:0;}
        @media only screen and (max-width:767px) {

        }
    `,
    'html': `
        <div id="grid_cols">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    `,
    setSize: function(maxWidth, gutters) {
        if (document.getElementById('new_css')) document.getElementById('new_css').remove();
        if (document.getElementById('grid')) document.getElementById('grid').remove();
        var searchRegExp = /ZZpx/g;
        var replaceWith = gutters + 'px';
        var new_css = document.createElement('style');
        new_css.id = 'new_css';
        new_css.innerHTML = grid.css.replace(searchRegExp, replaceWith);
        document.getElementsByTagName('head')[0].appendChild(new_css);
        var griddle = document.createElement('div');
        griddle.id = 'grid';
        griddle.setAttribute('class', 'hide-grid');
        griddle.innerHTML = grid.html;
        document.body.appendChild(griddle);
        document.getElementById('grid_cols').style.maxWidth = Math.floor(maxWidth + (gutters * 2)) + 'px';
        document.addEventListener('keypress', function(event) {
            if (event.keyCode == 103) {
                if (document.getElementById('grid').classList.contains('hide-grid')) {
                    document.getElementById('grid').classList.remove('hide-grid');
                } else {
                    document.getElementById('grid').classList.add('hide-grid');
                }
            }
        });
    }
}