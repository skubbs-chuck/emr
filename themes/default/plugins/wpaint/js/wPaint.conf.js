var scripts = document.getElementsByTagName("script");
var thisSrc = scripts[scripts.length-1].src;
thisSrc = thisSrc.replace(/js\/wPaint.conf.js$/, '');

/* wPaint Utils */  (function(){if(!String.prototype.capitalize){String.prototype.capitalize=function(){return this.slice(0,1).toUpperCase()+this.slice(1)}}})();(function($){$.fn.realWidth=function(type,margin,$el){var width=null,$div=null,method=null;type=type==='inner'||type==='outer'?type:'';method=type===''?'width':type+'Width';margin=margin===true?true:false;$div=$(this).clone().css({position:'absolute',left:-10000}).appendTo($el||'body');width=margin?$div[method](margin):$div[method]();$div.remove();return width};$.fn.realHeight=function(type,margin,$el){var height=null,$div=null,method=null;type=type==='inner'||type==='outer'?type:'';method=type===''?'height':type+'Height';margin=margin===true?true:false;$div=$(this).clone().css({position:'absolute',left:-10000}).appendTo($el||'body');height=margin?$div[method](margin):$div[method]();$div.remove();return height};$.fn.bindMobileEvents=function(){$(this).on('touchstart touchmove touchend touchcancel',function(){var touches=(event.changedTouches||event.originalEvent.targetTouches),first=touches[0],type='';switch(event.type){case'touchstart':type='mousedown';break;case'touchmove':type='mousemove';event.preventDefault();break;case'touchend':type='mouseup';break;default:return}var simulatedEvent=document.createEvent('MouseEvent');simulatedEvent.initMouseEvent(type,true,true,window,1,first.screenX,first.screenY,first.clientX,first.clientY,false,false,false,false,0,null);first.target.dispatchEvent(simulatedEvent)})}})(jQuery);
/* wPaint */
(function($) {
    'use strict';

    function Paint(el, options) {
        this.$el = $(el);
        this.options = options;
        this.init = false;
        this.menus = {
            primary: null,
            active: null,
            all: {}
        };
        this.previousMode = null;
        this.width = this.$el.width();
        this.height = this.$el.height();
        this.ctxBgResize = false;
        this.ctxResize = false;
        this.generate();
        this._init()
    }
    Paint.prototype = {
        generate: function() {
            if (this.init) {
                return this
            }
            var _this = this;

            function createCanvas(name) {
                var newName = (name ? name.capitalize() : ''),
                    canvasName = 'canvas' + newName,
                    ctxName = 'ctx' + newName;
                _this[canvasName] = document.createElement('canvas');
                _this[ctxName] = _this[canvasName].getContext('2d');
                _this['$' + canvasName] = $(_this[canvasName]);
                _this['$' + canvasName].attr('class', 'wPaint-canvas' + (name ? '-' + name : '')).attr('width', _this.width + 'px').attr('height', _this.height + 'px').css({
                    position: 'absolute',
                    left: 1,
                    top: 1
                });
                _this.$el.append(_this['$' + canvasName]);
                return _this['$' + canvasName]
            }

            function canvasMousedown(e) {
                e.preventDefault();
                e.stopPropagation();
                _this.draw = true;
                e.canvasEvent = 'down';
                _this._closeSelectBoxes();
                _this._callShapeFunc.apply(_this, [e])
            }

            function documentMousemove(e) {
                if (_this.draw) {
                    e.canvasEvent = 'move';
                    _this._callShapeFunc.apply(_this, [e])
                }
            }

            function documentMouseup(e) {
                if (_this.draw) {
                    _this.draw = false;
                    e.canvasEvent = 'up';
                    _this._callShapeFunc.apply(_this, [e])
                }
            }
            createCanvas('bg');
            createCanvas('').on('mousedown', canvasMousedown).bindMobileEvents();
            createCanvas('temp').hide();
            $(document).on('mousemove', documentMousemove).on('mousedown', $.proxy(this._closeSelectBoxes, this)).on('mouseup', documentMouseup);
            this.setTheme(this.options.theme)
        },
        _init: function() {
            var index = null,
                setFuncName = null;
            this.init = true;
            for (index in this.options) {
                setFuncName = 'set' + index.capitalize();
                if (this[setFuncName]) {
                    this[setFuncName](this.options[index])
                }
            }
            this._fixMenus();
            this.menus.primary._getIcon(this.options.mode).trigger('click')
        },
        resize: function() {
            var bg = this.getBg(),
                image = this.getImage();
            this.width = this.$el.width();
            this.height = this.$el.height();
            this.canvasBg.width = this.width;
            this.canvasBg.height = this.height;
            this.canvas.width = this.width;
            this.canvas.height = this.height;
            if (this.ctxBgResize === false) {
                this.ctxBgResize = true;
                this.setBg(bg, true)
            }
            if (this.ctxResize === false) {
                this.ctxResize = true;
                this.setImage(image, '', true, true)
            }
        },
        setTheme: function(theme) {
            var i, ii;
            theme = theme.split(' ');
            this.$el.attr('class', (this.$el.attr('class') || '').replace(/wPaint-theme-.+\s|wPaint-theme-.+$/, ''));
            for (i = 0, ii = theme.length; i < ii; i++) {
                this.$el.addClass('wPaint-theme-' + theme[i])
            }
        },
        setMode: function(mode) {
            this.setCursor(mode);
            this.previousMode = this.options.mode;
            this.options.mode = mode
        },
        setImage: function(img, ctxType, resize, notUndo) {
            if (!img) {
                return true
            }
            var _this = this,
                myImage = null,
                ctx = '';

            function loadImage() {
                var ratio = 1,
                    xR = 0,
                    yR = 0,
                    x = 0,
                    y = 0,
                    w = myImage.width,
                    h = myImage.height;
                if (!resize) {
                    if (myImage.width > _this.width || myImage.height > _this.height || _this.options.imageStretch) {
                        xR = _this.width / myImage.width;
                        yR = _this.height / myImage.height;
                        ratio = xR < yR ? xR : yR;
                        w = myImage.width * ratio;
                        h = myImage.height * ratio
                    }
                    x = (_this.width - w) / 2;
                    y = (_this.height - h) / 2
                }
                ctx.clearRect(0, 0, _this.width, _this.height);
                ctx.drawImage(myImage, x, y, w, h);
                _this[ctxType + 'Resize'] = false;
                if (!notUndo) {
                    _this._addUndo()
                }
            }
            ctxType = 'ctx' + (ctxType || '').capitalize();
            ctx = this[ctxType];
            if (window.rgbHex(img)) {
                ctx.clearRect(0, 0, this.width, this.height);
                ctx.fillStyle = img;
                ctx.rect(0, 0, this.width, this.height);
                ctx.fill()
            } else {
                myImage = new Image();
                myImage.src = img.toString();
                $(myImage).load(loadImage)
            }
        },
        setBg: function(img, resize) {
            if (!img) {
                return true
            }
            this.setImage(img, 'bg', resize, true)
        },
        setCursor: function(cursor) {
            cursor = $.fn.wPaint.cursors[cursor] || $.fn.wPaint.cursors['default'];
            this.$el.css('cursor', 'url("' + this.options.path + cursor.path + '") ' + cursor.left + ' ' + cursor.top + ', default')
        },
        setMenuOrientation: function(orientation) {
            $.each(this.menus.all, function(i, menu) {
                menu.options.aligment = orientation;
                menu.setAlignment(orientation)
            })
        },
        getImage: function(withBg) {
            var canvasSave = document.createElement('canvas'),
                ctxSave = canvasSave.getContext('2d');
            withBg = withBg === false ? false : true;
            $(canvasSave).css({
                display: 'none',
                position: 'absolute',
                left: 0,
                top: 0
            }).attr('width', this.width).attr('height', this.height);
            if (withBg) {
                ctxSave.drawImage(this.canvasBg, 0, 0)
            }
            ctxSave.drawImage(this.canvas, 0, 0);
            return canvasSave.toDataURL()
        },
        getBg: function() {
            return this.canvasBg.toDataURL()
        },
        _displayStatus: function(msg) {
            var _this = this;
            if (!this.$status) {
                this.$status = $('<div class="wPaint-status"></div>');
                this.$el.append(this.$status)
            }
            this.$status.html(msg);
            clearTimeout(this.displayStatusTimer);
            this.$status.fadeIn(500, function() {
                _this.displayStatusTimer = setTimeout(function() {
                    _this.$status.fadeOut(500)
                }, 1500)
            })
        },
        _showModal: function($content) {
            var _this = this,
                $bg = this.$el.children('.wPaint-modal-bg'),
                $modal = this.$el.children('.wPaint-modal');

            function modalFadeOut() {
                $bg.remove();
                $modal.remove();
                _this._createModal($content)
            }
            if ($bg.length) {
                $modal.fadeOut(500, modalFadeOut)
            } else {
                this._createModal($content)
            }
        },
        _createModal: function($content) {
            $content = $('<div class="wPaint-modal-content"></div>').append($content.children());
            var $bg = $('<div class="wPaint-modal-bg"></div>'),
                $modal = $('<div class="wPaint-modal"></div>'),
                $holder = $('<div class="wPaint-modal-holder"></div>'),
                $close = $('<div class="wPaint-modal-close">X</div>');

            function modalClick() {
                $modal.fadeOut(500, modalFadeOut)
            }

            function modalFadeOut() {
                $bg.remove();
                $modal.remove()
            }
            $close.on('click', modalClick);
            $modal.append($holder.append($content)).append($close);
            this.$el.append($bg).append($modal);
            $modal.css({
                left: (this.$el.outerWidth() / 2) - ($modal.outerWidth(true) / 2),
                top: (this.$el.outerHeight() / 2) - ($modal.outerHeight(true) / 2)
            });
            $modal.fadeIn(500)
        },
        _createMenu: function(name, options) {
            options = options || {};
            options.alignment = this.options.menuOrientation;
            options.handle = this.options.menuHandle;
            return new Menu(this, name, options)
        },
        _fixMenus: function() {
            var _this = this,
                $selectHolder = null;

            function selectEach(i, el) {
                var $el = $(el),
                    $select = $el.clone();
                $select.appendTo(_this.$el);
                if ($select.outerHeight() === $select.get(0).scrollHeight) {
                    $el.css({
                        overflowY: 'auto'
                    })
                }
                $select.remove()
            }
            for (var key in this.menus.all) {
                $selectHolder = _this.menus.all[key].$menu.find('.wPaint-menu-select-holder');
                if ($selectHolder.length) {
                    $selectHolder.children().each(selectEach)
                }
            }
        },
        _closeSelectBoxes: function(item) {
            var key, $selectBoxes;
            for (key in this.menus.all) {
                $selectBoxes = this.menus.all[key].$menuHolder.children('.wPaint-menu-icon-select');
                if (item) {
                    $selectBoxes = $selectBoxes.not('.wPaint-menu-icon-name-' + item.name)
                }
                $selectBoxes.children('.wPaint-menu-select-holder').hide()
            }
        },
        _callShapeFunc: function(e) {
            var canvasOffset = this.$canvas.offset(),
                canvasEvent = e.canvasEvent.capitalize(),
                func = '_draw' + this.options.mode.capitalize() + canvasEvent;
            e.pageX = Math.floor(e.pageX - canvasOffset.left);
            e.pageY = Math.floor(e.pageY - canvasOffset.top);
            if (this[func]) {
                this[func].apply(this, [e])
            }
            if (this.options['draw' + canvasEvent]) {
                this.options['_draw' + canvasEvent].apply(this, [e])
            }
            if (canvasEvent === 'Down' && this.options.onShapeDown) {
                this.options.onShapeDown.apply(this, [e])
            } else if (canvasEvent === 'Move' && this.options.onShapeMove) {
                this.options.onShapeMove.apply(this, [e])
            } else if (canvasEvent === 'Up' && this.options.onShapeUp) {
                this.options.onShapeUp.apply(this, [e])
            }
        },
        _stopPropagation: function(e) {
            e.stopPropagation()
        },
        _drawShapeDown: function(e) {
            this.$canvasTemp.css({
                left: e.PageX,
                top: e.PageY
            }).attr('width', 0).attr('height', 0).show();
            this.canvasTempLeftOriginal = e.pageX;
            this.canvasTempTopOriginal = e.pageY
        },
        _drawShapeMove: function(e, factor) {
            var xo = this.canvasTempLeftOriginal,
                yo = this.canvasTempTopOriginal;
            factor = factor || 2;
            e.left = (e.pageX < xo ? e.pageX : xo);
            e.top = (e.pageY < yo ? e.pageY : yo);
            e.width = Math.abs(e.pageX - xo);
            e.height = Math.abs(e.pageY - yo);
            e.x = this.options.lineWidth / 2 * factor;
            e.y = this.options.lineWidth / 2 * factor;
            e.w = e.width - this.options.lineWidth * factor;
            e.h = e.height - this.options.lineWidth * factor;
            $(this.canvasTemp).css({
                left: e.left,
                top: e.top
            }).attr('width', e.width).attr('height', e.height);
            this.canvasTempLeftNew = e.left;
            this.canvasTempTopNew = e.top;
            factor = factor || 2;
            this.ctxTemp.fillStyle = this.options.fillStyle;
            this.ctxTemp.strokeStyle = this.options.strokeStyle;
            this.ctxTemp.lineWidth = this.options.lineWidth * factor
        },
        _drawShapeUp: function() {
            this.ctx.drawImage(this.canvasTemp, this.canvasTempLeftNew, this.canvasTempTopNew);
            this.$canvasTemp.hide()
        },
        _drawDropperDown: function(e) {
            var pos = {
                    x: e.pageX,
                    y: e.pageY
                },
                pixel = this._getPixel(this.ctx, pos),
                color = null;
            color = 'rgba(' + [pixel.r, pixel.g, pixel.b, pixel.a].join(',') + ')';
            this.options[this.dropper] = color;
            this.menus.active._getIcon(this.dropper).wColorPicker('color', color)
        },
        _drawDropperUp: function() {
            this.setMode(this.previousMode)
        },
        _getPixel: function(ctx, pos) {
            var imageData = ctx.getImageData(0, 0, this.width, this.height),
                pixelArray = imageData.data,
                base = ((pos.y * imageData.width) + pos.x) * 4;
            return {
                r: pixelArray[base],
                g: pixelArray[base + 1],
                b: pixelArray[base + 2],
                a: pixelArray[base + 3]
            }
        }
    };

    function Menu(wPaint, name, options) {
        this.wPaint = wPaint;
        this.options = options;
        this.name = name;
        this.type = !wPaint.menus.primary ? 'primary' : 'secondary';
        this.docked = true;
        this.dockOffset = {
            left: 0,
            top: 0
        };
        this.generate()
    }
    Menu.prototype = {
        generate: function() {
            this.$menu = $('<div class="wPaint-menu"></div>');
            this.$menuHolder = $('<div class="wPaint-menu-holder wPaint-menu-name-' + this.name + '"></div>');
            this.$menu.addClass('wPaint-menu-nohandle');
            if (this.type === 'primary') {
                this.wPaint.menus.primary = this;
                this.setOffsetLeft(this.options.offsetLeft);
                this.setOffsetTop(this.options.offsetTop)
            } else if (this.type === 'secondary') {
                this.$menu.hide()
            }
            this.$menu.append(this.$menuHolder.append(this.$menuHandle));
            this.reset();
            // if (typeof $('#cPaintMenuWrapper') != 'undefined') {
            //     $('#cPaintMenuWrapper').append(this.$menu)
            // } else {
            //     this.wPaint.$el.append(this.$menu)
            // };
            // this.wPaint.$el.append(this.$menu);
            this.setAlignment(this.options.alignment)
        },
        reset: function() {
            var _this = this,
                menu = $.fn.wPaint.menus[this.name],
                key;

            function itemAppend(item) {
                _this._appendItem(item);
            }
            for (key in menu.items) {
                if (!this.$menuHolder.children('.wPaint-menu-icon-name-' + key).length) {
                    menu.items[key].name = key;
                    var imgPath = (typeof _this.wPaint.options.path != 'undefined') ? _this.wPaint.options.path : thisSrc;
                    if (typeof menu.items[key].img != 'undefined') {
                        menu.items[key].img = imgPath + menu.items[key].img.replace(imgPath, '')
                    };
                    if (typeof menu.items[key].img == 'undefined' && typeof menu.img != 'undefined') {
                        menu.items[key].img = imgPath + menu.img.replace(imgPath, '')
                    };
                    (itemAppend)(menu.items[key])
                }
            }
        },
        _appendItem: function(item) {
            var $item = this['_createIcon' + item.icon.capitalize()](item);
            if (item.after) {
                this.$menuHolder.children('.wPaint-menu-icon-name-' + item.after).after($item);
            } else {
                this.$menuHolder.append($item);
            }
        },
        setOffsetLeft: function(left) {
            this.$menu.css({
                left: left
            })
        },
        setOffsetTop: function(top) {
            this.$menu.css({
                top: top
            })
        },
        setAlignment: function(alignment) {
            var tempLeft = this.$menu.css('left');
            this.$menu.attr('class', this.$menu.attr('class').replace(/wPaint-menu-alignment-.+\s|wPaint-menu-alignment-.+$/, ''));
            this.$menu.addClass('wPaint-menu-alignment-' + alignment);
            this.$menu.width('auto').css('left', -10000);
            this.$menu.width(this.$menu.width()).css('left', tempLeft);
            if (this.type === 'secondary') {
                if (this.options.alignment === 'horizontal') {
                    this.dockOffset.top = this.wPaint.menus.primary.$menu.outerHeight(true)
                } else {
                    this.dockOffset.left = this.wPaint.menus.primary.$menu.outerWidth(true)
                }
            }
        },
        _createHandle: function() {
            var _this = this,
                $handle = $('<div class="wPaint-menu-handle"></div>');

            function draggableStart() {
                _this.docked = false;
                _this._setDrag()
            }

            function draggableStop() {
                $.each(_this.$menu.data('ui-draggable').snapElements, function(i, el) {
                    var offset = _this.$menu.offset(),
                        offsetPrimary = _this.wPaint.menus.primary.$menu.offset();
                    _this.dockOffset.left = offset.left - offsetPrimary.left;
                    _this.dockOffset.top = offset.top - offsetPrimary.top;
                    _this.docked = el.snapping
                });
                _this._setDrag()
            }

            function draggableDrag() {
                _this._setIndex()
            }
            this.$menu.draggable({
                handle: $handle
            });
            if (this.type === 'secondary') {
                this.$menu.draggable('option', 'snap', this.wPaint.menus.primary.$menu);
                this.$menu.draggable('option', 'start', draggableStart);
                this.$menu.draggable('option', 'stop', draggableStop);
                this.$menu.draggable('option', 'drag', draggableDrag)
            }
            $handle.bindMobileEvents();
            return $handle
        },
        _createIconBase: function(item) {
            var _this = this,
                $icon = $('<div class="wPaint-menu-icon wPaint-menu-icon-name-' + item.name + '"></div>'),
                $iconImg = $('<div class="wPaint-menu-icon-img"></div>'),
                width = $iconImg.realWidth(null, null, this.wPaint.$el);

            function mouseenter(e) {
                var $el = $(e.currentTarget);
                $el.siblings('.hover').removeClass('hover');
                if (!$el.hasClass('disabled')) {
                    $el.addClass('hover')
                }
            }

            function mouseleave(e) {
                $(e.currentTarget).removeClass('hover')
            }

            function click() {
                _this.wPaint.menus.active = _this
            }
            $icon.attr('title', item.title).on('mousedown', $.proxy(this.wPaint._closeSelectBoxes, this.wPaint, item)).on('mouseenter', mouseenter).on('mouseleave', mouseleave).on('click', click);
            if ($.isNumeric(item.index)) {
                $iconImg.css({
                    backgroundImage: 'url(' + item.img + ')',
                    backgroundPosition: (-width * item.index) + 'px 0px'
                })
            }
            return $icon.append($iconImg)
        },
        _createIconGroup: function(item) {
            var _this = this,
                css = {
                    backgroundImage: 'url(' + item.img + ')'
                },
                $icon = this.$menuHolder.children('.wPaint-menu-icon-group-' + item.group),
                iconExists = $icon.length,
                $selectHolder = null,
                $option = null,
                $item = null,
                width = 0;

            function setIconClick() {
                if (!$icon.children('.wPaint-menu-select-holder').is(':visible')) {
                    item.callback.apply(_this.wPaint, [])
                }
            }

            function selectHolderClick() {
                $icon.addClass('active').siblings('.active').removeClass('active')
            }

            function optionClick() {
                $icon.attr('title', item.title).off('click.setIcon').on('click.setIcon', setIconClick);
                $icon.children('.wPaint-menu-icon-img').css(css);
                item.callback.apply(_this.wPaint, [])
            }
            if (!iconExists) {
                $icon = this._createIconBase(item).addClass('wPaint-menu-icon-group wPaint-menu-icon-group-' + item.group).on('click.setIcon', setIconClick).on('mousedown', $.proxy(this._iconClick, this))
            }
            width = $icon.children('.wPaint-menu-icon-img').realWidth(null, null, this.wPaint.$el);
            css.backgroundPosition = (-width * item.index) + 'px center';
            $selectHolder = $icon.children('.wPaint-menu-select-holder');
            if (!$selectHolder.length) {
                $selectHolder = this._createSelectBox($icon);
                $selectHolder.children().on('click', selectHolderClick)
            }
            $item = $('<div class="wPaint-menu-icon-select-img"></div>').attr('title', item.title).css(css);
            $option = this._createSelectOption($selectHolder, $item).addClass('wPaint-menu-icon-name-' + item.name).on('click', optionClick);
            if (item.after) {
                $selectHolder.children('.wPaint-menu-select').children('.wPaint-menu-icon-name-' + item.after).after($option)
            }
            if (!iconExists) {
                return $icon
            }
        },
        _createIconGeneric: function(item) {
            return this._createIconActivate(item)
        },
        _createIconActivate: function(item) {
            if (item.group) {
                return this._createIconGroup(item)
            }
            var _this = this,
                $icon = this._createIconBase(item);

            function iconClick(e) {
                if (item.icon !== 'generic') {
                    _this._iconClick(e)
                }
                item.callback.apply(_this.wPaint, [e])
            }
            $icon.on('click', iconClick);
            return $icon
        },
        _isIconDisabled: function(name) {
            return this.$menuHolder.children('.wPaint-menu-icon-name-' + name).hasClass('disabled')
        },
        _setIconDisabled: function(name, disabled) {
            var $icon = this.$menuHolder.children('.wPaint-menu-icon-name-' + name);
            if (disabled) {
                $icon.addClass('disabled').removeClass('hover')
            } else {
                $icon.removeClass('disabled')
            }
        },
        _getIcon: function(name) {
            return this.$menuHolder.children('.wPaint-menu-icon-name-' + name)
        },
        _iconClick: function(e) {
            var $el = $(e.currentTarget),
                menus = this.wPaint.menus.all;
            for (var menu in menus) {
                if (menus[menu] && menus[menu].type === 'secondary') {
                    menus[menu].$menu.hide()
                }
            }
            $el.siblings('.active').removeClass('active');
            if (!$el.hasClass('disabled')) {
                $el.addClass('active')
            }
        },
        _createIconToggle: function(item) {
            var _this = this,
                $icon = this._createIconBase(item);

            function iconClick() {
                $icon.toggleClass('active');
                item.callback.apply(_this.wPaint, [$icon.hasClass('active')])
            }
            $icon.on('click', iconClick);
            return $icon
        },
        _createIconSelect: function(item) {
            var _this = this,
                $icon = this._createIconBase(item),
                $selectHolder = this._createSelectBox($icon),
                i, ii, $option;

            function optionClick(e) {
                $icon.children('.wPaint-menu-icon-img').html($(e.currentTarget).html());
                item.callback.apply(_this.wPaint, [$(e.currentTarget).html()])
            }
            for (i = 0, ii = item.range.length; i < ii; i++) {
                $option = this._createSelectOption($selectHolder, item.range[i]);
                $option.on('click', optionClick);
                if (item.useRange) {
                    $option.css(item.name, item.range[i])
                }
            }
            return $icon
        },
        _createSelectBox: function($icon) {
            var $selectHolder = $('<div class="wPaint-menu-select-holder"></div>'),
                $select = $('<div class="wPaint-menu-select"></div>'),
                timer = null;

            function clickSelectHolder(e) {
                e.stopPropagation();
                $selectHolder.hide()
            }

            function iconMousedown() {
                timer = setTimeout(function() {
                    $selectHolder.toggle()
                }, 200)
            }

            function iconMouseup() {
                clearTimeout(timer)
            }

            function iconClick() {
                $selectHolder.toggle()
            }
            $selectHolder.on('mousedown mouseup', this.wPaint._stopPropagation).on('click', clickSelectHolder).hide();
            if (this.options.alignment === 'horizontal') {
                $selectHolder.css({
                    left: 0,
                    top: $icon.children('.wPaint-menu-icon-img').realHeight('outer', true, this.wPaint.$el)
                })
            } else {
                $selectHolder.css({
                    left: $icon.children('.wPaint-menu-icon-img').realWidth('outer', true, this.wPaint.$el),
                    top: 0
                })
            }
            $icon.addClass('wPaint-menu-icon-select').append('<div class="wPaint-menu-icon-group-arrow"></div>').append($selectHolder.append($select));
            if ($icon.hasClass('wPaint-menu-icon-group')) {
                $icon.on('mousedown', iconMousedown).on('mouseup', iconMouseup)
            } else {
                $icon.on('click', iconClick)
            }
            return $selectHolder
        },
        _createSelectOption: function($selectHolder, value) {
            var $select = $selectHolder.children('.wPaint-menu-select'),
                $option = $('<div class="wPaint-menu-select-option"></div>').append(value);
            if (!$select.children().length) {
                $option.addClass('first')
            }
            $select.append($option);
            return $option
        },
        _setSelectValue: function(icon, value) {
            this._getIcon(icon).children('.wPaint-menu-icon-img').html(value)
        },
        _createIconColorPicker: function(item) {
            var _this = this,
                $icon = this._createIconBase(item);

            function iconClick() {
                if (_this.wPaint.options.mode === 'dropper') {
                    _this.wPaint.setMode(_this.wPaint.previousMode)
                }
            }

            function iconOnSelect(color) {
                item.callback.apply(_this.wPaint, [color])
            }

            function iconOnDropper() {
                $icon.trigger('click');
                _this.wPaint.dropper = item.name;
                _this.wPaint.setMode('dropper')
            }
            $icon.on('click', iconClick).addClass('wPaint-menu-colorpicker').wColorPicker({
                mode: 'click',
                generateButton: false,
                dropperButton: true,
                onSelect: iconOnSelect,
                onDropper: iconOnDropper
            });
            return $icon
        },
        _setColorPickerValue: function(icon, value) {
            this._getIcon(icon).children('.wPaint-menu-icon-img').css('backgroundColor', value)
        },
        _createIconMenu: function(item) {
            var _this = this,
                $icon = this._createIconActivate(item);

            function iconClick() {
                _this.wPaint.setCursor(item.name);
                var menu = _this.wPaint.menus.all[item.name];
                menu.$menu.toggle();
                if (_this.handle) {
                    menu._setDrag()
                } else {
                    menu._setPosition()
                }
            }
            $icon.on('click', iconClick);
            return $icon
        },
        _setDrag: function() {
            var $menu = this.$menu,
                drag = null,
                stop = null;
            if ($menu.is(':visible')) {
                if (this.docked) {
                    drag = stop = $.proxy(this._setPosition, this);
                    this._setPosition()
                }
                this.wPaint.menus.primary.$menu.draggable('option', 'drag', drag);
                this.wPaint.menus.primary.$menu.draggable('option', 'stop', stop)
            }
        },
        _setPosition: function() {
            var offset = this.wPaint.menus.primary.$menu.position();
            this.$menu.css({
                left: offset.left + this.dockOffset.left,
                top: offset.top + this.dockOffset.top
            })
        },
        _setIndex: function() {
            var primaryOffset = this.wPaint.menus.primary.$menu.offset(),
                secondaryOffset = this.$menu.offset();
            if (secondaryOffset.top < primaryOffset.top || secondaryOffset.left < primaryOffset.left) {
                this.$menu.addClass('wPaint-menu-behind')
            } else {
                this.$menu.removeClass('wPaint-menu-behind')
            }
        }
    };
    $.support.canvas = (document.createElement('canvas')).getContext;
    $.fn.wPaint = function(options, value) {
        function create() {
            if (!$.support.canvas) {
                $(this).html('Browser does not support HTML5 canvas, please upgrade to a more modern browser.');
                return false
            }
            return $.proxy(get, this)()
        }

        function get() {
            var wPaint = $.data(this, 'wPaint');
            if (!wPaint) {
                wPaint = new Paint(this, $.extend(true, {}, options));
                $.data(this, 'wPaint', wPaint)
            }
            return wPaint
        }

        function runOpts() {
            var wPaint = $.data(this, 'wPaint');
            if (wPaint) {
                if (wPaint[options]) {
                    wPaint[options].apply(wPaint, [value])
                } else if (value !== undefined) {
                    if (wPaint[func]) {
                        wPaint[func].apply(wPaint, [value])
                    }
                    if (wPaint.options[options]) {
                        wPaint.options[options] = value
                    }
                } else {
                    if (wPaint[func]) {
                        values.push(wPaint[func].apply(wPaint, [value]))
                    } else if (wPaint.options[options]) {
                        values.push(wPaint.options[options])
                    } else {
                        values.push(undefined)
                    }
                }
            }
        }
        if (typeof options === 'string') {
            var values = [],
                func = (value ? 'set' : 'get') + options.charAt(0).toUpperCase() + options.substring(1);
                // console.log({
                //     f : func, 
                //     o : options, 
                //     v : value
                // });
            this.each(runOpts);
            // console.log(test);
            if (values.length) {
                return values.length === 1 ? values[0] : values
            }
            return this
        }
        options = $.extend({}, $.fn.wPaint.defaults, options);
        options.lineWidth = parseInt(options.lineWidth, 10);
        options.fontSize = parseInt(options.fontSize, 10);
        return this.each(create)
    };
    $.fn.wPaint.extend = function(funcs, protoType) {
        var key;

        function elEach(func) {
            if (protoType[func]) {
                var tmpFunc = Paint.prototype[func],
                    newFunc = funcs[func];
                protoType[func] = function() {
                    tmpFunc.apply(this, arguments);
                    newFunc.apply(this, arguments)
                }
            } else {
                protoType[func] = funcs[func]
            }
        }
        protoType = protoType === 'menu' ? Menu.prototype : Paint.prototype;
        for (key in funcs) {
            (elEach)(key)
        }
    };
    $.fn.wPaint.menus = {};
    $.fn.wPaint.cursors = {};
    $.fn.wPaint.defaults = {
        path: thisSrc,
        theme: 'standard classic',
        autoScaleImage: true,
        autoCenterImage: true,
        menuHandle: true,
        menuOrientation: 'horizontal',
        menuOffsetLeft: 5,
        menuOffsetTop: 5,
        bg: null,
        image: null,
        imageStretch: false,
        onShapeDown: null,
        onShapeMove: null,
        onShapeUp: null
    }
})(jQuery);
/* fillArea */      !function(){window.CanvasRenderingContext2D&&(CanvasRenderingContext2D.prototype.fillArea=function(a,b,c){function d(a){return{r:p[a],g:p[a+1],b:p[a+2],a:p[a+3]}}function e(a){p[a]=c.r,p[a+1]=c.g,p[a+2]=c.b,p[a+3]=c.a}function f(a){return g.r===a.r&&g.g===a.g&&g.b===a.b&&g.a===a.a}if(!a||!b||!c)return!0;var g,h,i,j,k,l,m=this.canvas.width,n=this.canvas.height,o=this.getImageData(0,0,m,n),p=o.data,q=[[a,b]];if(g=d(4*(b*m+a)),l=this.canvas.style.color,this.canvas.style.color=c,c=this.canvas.style.color.match(/^rgba?\((.*)\);?$/)[1].split(","),this.canvas.style.color=l,c={r:parseInt(c[0],10),g:parseInt(c[1],10),b:parseInt(c[2],10),a:parseInt(c[3]||255,10)},f(c))return!0;for(;q.length;){for(h=q.pop(),i=4*(h[1]*m+h[0]);h[1]-->=0&&f(d(i));)i-=4*m;for(i+=4*m,++h[1],j=!1,k=!1;h[1]++<n-1&&f(d(i));)e(i),h[0]>0&&(f(d(i-4))?j||(q.push([h[0]-1,h[1]]),j=!0):j&&(j=!1)),h[0]<m-1&&(f(d(i+4))?k||(q.push([h[0]+1,h[1]]),k=!0):k&&(k=!1)),i+=4*m}this.putImageData(o,0,0)})}();
/* shapes */        !function(){window.CanvasRenderingContext2D&&(CanvasRenderingContext2D.prototype.diamond=function(a,b,c,d){return a&&b&&c&&d?(this.beginPath(),this.moveTo(a+.5*c,b),this.lineTo(a,b+.5*d),this.lineTo(a+.5*c,b+d),this.lineTo(a+c,b+.5*d),this.lineTo(a+.5*c,b),this.closePath(),void 0):!0}),window.CanvasRenderingContext2D&&(CanvasRenderingContext2D.prototype.ellipse=function(a,b,c,d){if(!(a&&b&&c&&d))return!0;var e=.5522848,f=c/2*e,g=d/2*e,h=a+c,i=b+d,j=a+c/2,k=b+d/2;this.beginPath(),this.moveTo(a,k),this.bezierCurveTo(a,k-g,j-f,b,j,b),this.bezierCurveTo(j+f,b,h,k-g,h,k),this.bezierCurveTo(h,k+g,j+f,i,j,i),this.bezierCurveTo(j-f,i,a,k+g,a,k),this.closePath()}),window.CanvasRenderingContext2D&&(CanvasRenderingContext2D.prototype.hexagon=function(a,b,c,d){if(!(a&&b&&c&&d))return!0;var e=.225,f=1-e;this.beginPath(),this.moveTo(a+.5*c,b),this.lineTo(a,b+d*e),this.lineTo(a,b+d*f),this.lineTo(a+.5*c,b+d),this.lineTo(a+c,b+d*f),this.lineTo(a+c,b+d*e),this.lineTo(a+.5*c,b),this.closePath()}),window.CanvasRenderingContext2D&&(CanvasRenderingContext2D.prototype.pentagon=function(a,b,c,d){return a&&b&&c&&d?(this.beginPath(),this.moveTo(a+c/2,b),this.lineTo(a,b+.4*d),this.lineTo(a+.2*c,b+d),this.lineTo(a+.8*c,b+d),this.lineTo(a+c,b+.4*d),this.lineTo(a+c/2,b),this.closePath(),void 0):!0}),window.CanvasRenderingContext2D&&(CanvasRenderingContext2D.prototype.roundedRect=function(a,b,c,d,e){return a&&b&&c&&d?(e||(e=5),this.beginPath(),this.moveTo(a+e,b),this.lineTo(a+c-e,b),this.quadraticCurveTo(a+c,b,a+c,b+e),this.lineTo(a+c,b+d-e),this.quadraticCurveTo(a+c,b+d,a+c-e,b+d),this.lineTo(a+e,b+d),this.quadraticCurveTo(a,b+d,a,b+d-e),this.lineTo(a,b+e),this.quadraticCurveTo(a,b,a+e,b),this.closePath(),void 0):!0})}();

(function($) {
    // setup menu
    $.fn.wPaint.menus.main={items:{
        eraser      : {icon:"activate",title:"Eraser",index:0,img:"img/icon_eraser.png",callback:function(){this.setMode("eraser")}},
        fillStyle   : {title:"Fill Color",icon:"colorPicker",callback:function(i){this.setFillStyle(i)}},
        strokeStyle : {icon:"colorPicker",title:"Stroke Color",callback:function(i){this.setStrokeStyle(i)}},
        lineWidth   : {icon:"select",title:"Stroke Width",range:[1,2,3,4,5,6,7,8,9,10],value:2,callback:function(i){this.setLineWidth(i)}},
        pencil      : {icon:"activate",title:"Pencil",index:0,img:"img/icon_pencil.png",callback:function(){this.setMode("pencil")}},
        text        : {icon:"menu",title:"Text",index:0,img:"img/icon_text.png",callback:function(){this.setMode("text")}},
        bucket      : {icon:"activate",title:"Bucket",index:0,img:"img/icon_fill.png",callback:function(){this.setMode("bucket")}},
        rectangle   : {icon:"activate",title:"Rectangle",index:0,img:"img/icon_rectangle.png",callback:function(){this.setMode("rectangle")}},
        ellipse     : {icon:"activate",title:"Ellipse",index:0,img:"img/icon_ellipse.png",callback:function(){this.setMode("ellipse")}},
        line        : {icon:"activate",title:"Line",index:0,img:"img/icon_line.png",callback:function(){this.setMode("line")}},
        undo        : {icon:"generic",title:"Undo",index:0,img:"img/icon_undo.png",callback:function(){this.undo()}},
        redo        : {icon:"generic",title:"Redo",index:0,img:"img/icon_redo.png",callback:function(){this.redo()}},
        clear       : {icon:"generic",title:"Clear",index:0,img:"img/icon_clear.png",callback:function(){this.clear()}},
        save        : {icon:"generic",title:"Save Image",index:0,img:"img/icon_save.png",callback:function(){this.options.saveImg.apply(this,[this.getImage()])}}
    }};

    $.fn.wPaint.menus.text={items:{
        bold       : {icon:"toggle",title:"Bold",index:0,img:"img/icon_bold.png",callback:function(i){this.setFontBold(i)}},
        italic     : {icon:"toggle",title:"Italic",index:0,img:"img/icon_italic.png",callback:function(i){this.setFontItalic(i)}},
        fontSize   : {title:"Font Size",icon:"select",range:[8,9,10,12,14,16,20,24,30],value:12,callback:function(i){this.setFontSize(i)}},
        fontFamily : {icon:"select",title:"Font Family",range:["Arial","Courier","Times","Verdana"],useRange:!0,value:"Arial",callback:function(i){this.setFontFamily(i)}}
    }};

    // extend cursors
    $.extend($.fn.wPaint.cursors, {
        'default': {path: 'img/cursor-crosshair.png', left: 7, top: 7},
        dropper:   {path: 'img/cursor-dropper.png', left: 0, top: 12},
        pencil:    {path: 'img/cursor-pencil.png', left: 0, top: 11.99},
        bucket:    {path: 'img/cursor-bucket.png', left: 0, top: 10},
        eraser1:   {path: 'img/cursor-eraser1.png', left: 1, top: 1},
        eraser2:   {path: 'img/cursor-eraser2.png', left: 2, top: 2},
        eraser3:   {path: 'img/cursor-eraser3.png', left: 2, top: 2},
        eraser4:   {path: 'img/cursor-eraser4.png', left: 3, top: 3},
        eraser5:   {path: 'img/cursor-eraser5.png', left: 3, top: 3},
        eraser6:   {path: 'img/cursor-eraser6.png', left: 4, top: 4},
        eraser7:   {path: 'img/cursor-eraser7.png', left: 4, top: 4},
        eraser8:   {path: 'img/cursor-eraser8.png', left: 5, top: 5 },
        eraser9:   {path: 'img/cursor-eraser9.png', left: 5, top: 5},
        eraser10:  {path: 'img/cursor-eraser10.png', left: 6, top: 6}
    });

    // extend defaults
    $.extend($.fn.wPaint.defaults, {
        // path: thisSrc,
        /* Main */
        mode          : 'pencil',  // set mode
        lineWidth     : '5',       // starting line width
        fillStyle     : '#f00', // starting fill style
        strokeStyle   : '#000',  // start stroke style
        /* Text */
        fontSize      : '12',    // current font size for text input
        fontFamily    : 'Arial', // active font family for text input
        fontBold      : false,   // text input bold enable/disable
        fontItalic    : false,   // text input italic enable/disable
        fontUnderline : false,    // text input italic enable/disable
        /* File */
        saveImg       : null,   // callback triggerd on image save
        // loadImgFg     : null, // callback triggered on image fg
        // loadImgBg     : null  // callback triggerd on image bg
    });

    // extend functions
    /* Main */ $.fn.wPaint.extend({undoCurrent:-1,undoArray:[],setUndoFlag:true,generate:function(){this.menus.all.main=this._createMenu('main',{offsetLeft:this.options.menuOffsetLeft,offsetTop:this.options.menuOffsetTop})},_init:function(){this._addUndo();this.menus.all.main._setIconDisabled('clear',true)},setStrokeStyle:function(color){this.options.strokeStyle=color;this.menus.all.main._setColorPickerValue('strokeStyle',color)},setLineWidth:function(width){this.options.lineWidth=width;this.menus.all.main._setSelectValue('lineWidth',width);this.setCursor(this.options.mode)},setFillStyle:function(color){this.options.fillStyle=color;this.menus.all.main._setColorPickerValue('fillStyle',color)},setCursor:function(cursor){if(cursor==='eraser'){this.setCursor('eraser'+this.options.lineWidth)}},undo:function(){if(this.undoArray[this.undoCurrent-1]){this._setUndo(--this.undoCurrent)}this._undoToggleIcons()},redo:function(){if(this.undoArray[this.undoCurrent+1]){this._setUndo(++this.undoCurrent)}this._undoToggleIcons()},_addUndo:function(){if(this.undoCurrent<this.undoArray.length-1){this.undoArray[++this.undoCurrent]=this.getImage(false)}else{this.undoArray.push(this.getImage(false));if(this.undoArray.length>this.undoMax){this.undoArray=this.undoArray.slice(1,this.undoArray.length)}else{this.undoCurrent++}}while(this.undoCurrent!==this.undoArray.length-1){this.undoArray.pop()}this._undoToggleIcons();this.menus.all.main._setIconDisabled('clear',false)},_undoToggleIcons:function(){var undoIndex=(this.undoCurrent>0&&this.undoArray.length>1)?0:1,redoIndex=(this.undoCurrent<this.undoArray.length-1)?2:3;this.menus.all.main._setIconDisabled('undo',undoIndex===1?true:false);this.menus.all.main._setIconDisabled('redo',redoIndex===3?true:false)},_setUndo:function(undoCurrent){this.setImage(this.undoArray[undoCurrent],null,null,true)},clear:function(){if(!this.menus.all.main._isIconDisabled('clear')){this.ctx.clearRect(0,0,this.width,this.height);this._addUndo();this.menus.all.main._setIconDisabled('clear',true)}},_drawRectangleDown:function(e){this._drawShapeDown(e)},_drawRectangleMove:function(e){this._drawShapeMove(e);this.ctxTemp.rect(e.x,e.y,e.w,e.h);this.ctxTemp.stroke();this.ctxTemp.fill()},_drawRectangleUp:function(e){this._drawShapeUp(e);this._addUndo()},_drawEllipseDown:function(e){this._drawShapeDown(e)},_drawEllipseMove:function(e){this._drawShapeMove(e);this.ctxTemp.ellipse(e.x,e.y,e.w,e.h);this.ctxTemp.stroke();this.ctxTemp.fill()},_drawEllipseUp:function(e){this._drawShapeUp(e);this._addUndo()},_drawLineDown:function(e){this._drawShapeDown(e)},_drawLineMove:function(e){this._drawShapeMove(e,1);var xo=this.canvasTempLeftOriginal;var yo=this.canvasTempTopOriginal;if(e.pageX<xo){e.x=e.x+e.w;e.w=e.w*-1}if(e.pageY<yo){e.y=e.y+e.h;e.h=e.h*-1}this.ctxTemp.lineJoin='round';this.ctxTemp.beginPath();this.ctxTemp.moveTo(e.x,e.y);this.ctxTemp.lineTo(e.x+e.w,e.y+e.h);this.ctxTemp.closePath();this.ctxTemp.stroke()},_drawLineUp:function(e){this._drawShapeUp(e);this._addUndo()},_drawPencilDown:function(e){this.ctx.lineJoin='round';this.ctx.lineCap='round';this.ctx.strokeStyle=this.options.strokeStyle;this.ctx.fillStyle=this.options.strokeStyle;this.ctx.lineWidth=this.options.lineWidth;this.ctx.beginPath();this.ctx.arc(e.pageX,e.pageY,this.options.lineWidth/2,0,Math.PI*2,true);this.ctx.closePath();this.ctx.fill();this.ctx.beginPath();this.ctx.moveTo(e.pageX,e.pageY)},_drawPencilMove:function(e){this.ctx.lineTo(e.pageX,e.pageY);this.ctx.stroke()},_drawPencilUp:function(){this.ctx.closePath();this._addUndo()},_drawEraserDown:function(e){this.ctx.save();this.ctx.globalCompositeOperation='destination-out';this._drawPencilDown(e)},_drawEraserMove:function(e){this._drawPencilMove(e)},_drawEraserUp:function(e){this._drawPencilUp(e);this.ctx.restore()},_drawBucketDown:function(e){this.ctx.fillArea(e.pageX,e.pageY,this.options.fillStyle);this._addUndo()}});
    /* Text */ $.fn.wPaint.extend({generate:function(){this.$textCalc=$('<div></div>').hide();this.$textInput=$('<textarea class="wPaint-text-input" spellcheck="false"></textarea>').on('mousedown',this._stopPropagation).css({position:'absolute'}).hide();$('body').append(this.$textCalc);this.$el.append(this.$textInput);this.menus.all.text=this._createMenu('text')},_init:function(){var _this=this;function inputClick(){_this._drawTextIfNotEmpty();_this.$textInput.hide();_this.$canvasTemp.hide()}for(var i in this.menus.all){this.menus.all[i].$menu.on('click',inputClick).on('mousedown',this._stopPropagation)}$(document).on('mousedown',inputClick)},setFillStyle:function(fillStyle){this.$textInput.css('color',fillStyle)},setFontSize:function(size){this.options.fontSize=parseInt(size,10);this._setFont({fontSize:size+'px',lineHeight:size+'px'});this.menus.all.text._setSelectValue('fontSize',size)},setFontFamily:function(family){this.options.fontFamily=family;this._setFont({fontFamily:family});this.menus.all.text._setSelectValue('fontFamily',family)},setFontBold:function(bold){this.options.fontBold=bold;this._setFont({fontWeight:(bold?'bold':'')})},setFontItalic:function(italic){this.options.fontItalic=italic;this._setFont({fontStyle:(italic?'italic':'')})},setFontUnderline:function(underline){this.options.fontUnderline=underline;this._setFont({'text-decorati`on':(underline?'underline':'')})},_setFont:function(css){this.$textInput.css(css);this.$textCalc.css(css)},_drawTextDown:function(e){this._drawTextIfNotEmpty();this._drawShapeDown(e,1);this.$textInput.css({left:e.pageX-1,top:e.pageY-1,width:0,height:0}).show().focus()},_drawTextMove:function(e){this._drawShapeMove(e,1);this.$textInput.css({left:e.left-1,top:e.top-1,width:e.width,height:e.height})},_drawTextIfNotEmpty:function(){if(this.$textInput.val()!==''){this._drawText()}},_drawText:function(){var fontString='',lines=this.$textInput.val().split('\n'),linesNew=[],textInputWidth=this.$textInput.width()-2,width=0,lastj=0,offset=this.$textInput.position(),left=offset.left+1,top=offset.top+1,i,ii,j,jj;if(this.options.fontItalic){fontString+='italic '}if(this.options.fontBold){fontString+='bold '}fontString+=this.options.fontSize+'px '+this.options.fontFamily;for(i=0,ii=lines.length;i<ii;i++){this.$textCalc.html('');lastj=0;for(j=0,jj=lines[0].length;j<jj;j++){width=this.$textCalc.append(lines[i][j]).width();if(width>textInputWidth){linesNew.push(lines[i].substring(lastj,j));lastj=j;this.$textCalc.html(lines[i][j])}}if(lastj!==j){linesNew.push(lines[i].substring(lastj,j))}}lines=this.$textInput.val(linesNew.join('\n')).val().split('\n');for(i=0,ii=lines.length;i<ii;i++){this.ctx.fillStyle=this.options.fillStyle;this.ctx.textBaseline='top';this.ctx.font=fontString;this.ctx.fillText(lines[i],left,top);top+=this.options.fontSize}this.$textInput.val('');this._addUndo()}});
    /* File */ $.fn.wPaint.extend({_showFileModal:function(type,images){var _this=this,$content=$('<div></div>'),$img=null;function appendContent(type,image){function imgClick(e){e.stopPropagation();if(type==='fg'){_this.setImage(image)}else if(type==='bg'){_this.setBg(image,null,null,true)}}$img.on('click',imgClick)}for(var i=0,ii=images.length;i<ii;i++){$img=$('<img class="wPaint-modal-img"/>').attr('src',images[i]);$img=$('<div class="wPaint-modal-img-holder"></div>').append($img);(appendContent)(type,images[i]);$content.append($img)}this._showModal($content)}});



    // $.fn.wPaint.extend({
    //     cGetImg: function() {
    //         var _this = this;

    //         console.log(_this);
    //     }
    // });
})(jQuery);