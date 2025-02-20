<section class="content">
    <div class="row"><div class="col-md-12"><form id="widget-form-67b684958e9d1" method="POST" action="" class="form-horizontal" accept-charset="UTF-8" pjax-container="1">
                <div class="box-body fields-group">
                    <div class="form-group  ">
                        <label for="number" class="col-sm-2  control-label">账号</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                <input type="text" id="number" name="number" value="{{$number}}" class="form-control number" placeholder="请输入账号进行搜索">
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="_token" value="6JlmuBNRBMt5OHnq8AtmNCmcMjzw8mzKZdCyUvVB">

                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-2"></div>

                    <div class="col-md-8">
                        <div class="btn-group pull-left">
                            <button type="reset" class="btn btn-warning pull-right">重置</button>
                        </div>

                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-info pull-right">提交</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row"><div class="col-md-12"><div class="box">

                <div class="box-header">

                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm tree-67b457e81d3a3-tree-tools" data-action="expand" title="展开">
                            <i class="fa fa-plus-square-o"></i>&nbsp;展开
                        </a>
                        <a class="btn btn-primary btn-sm tree-67b457e81d3a3-tree-tools" data-action="collapse" title="收起">
                            <i class="fa fa-minus-square-o"></i>&nbsp;收起
                        </a>
                    </div>
                    <div class="btn-group">
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="dd" id="tree-mer">
                        <ol class="dd-list">
                            @foreach ($data as $member)
                                <li class="dd-item" data-id="{{$member->id}}">
                                    <div class="dd-handle">
                                        {{$member->id}} - {{$member->number}} - {{$member->real_name}} - L{{$member->level}}
                                    </div>
                                    @if(!empty($member->children))
                                        <ol class="dd-list">
                                            @foreach($member->children as $child)
                                                <li class="dd-item" data-id="{{$child->id}}">
                                                    @if(!empty($child->children->toArray()))
                                                        <button data-action="getexpand"  data-id="{{$child->id}}" type="button">Expand</button>
                                                    @endif
                                                    <div class="dd-handle">
                                                        {{$child->id}} - {{$child->number}} - {{$child->real_name}} - L{{$child->level}}
                                                    </div>

                                                </li>

                                            @endforeach

                                        </ol>
                                    @endif

                                </li>




                            @endforeach

                        </ol>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>

<script data-exec-on-popstate>$(function () {

    $('#tree-mer').nestablenew1([]);

        $('.tree_branch_delete').click(function() {
            var id = $(this).data('id');
            swal({
                title: "确认删除?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认",
                showLoaderOnConfirm: true,
                cancelButtonText: "取消",
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            method: 'post',
                            url: 'http://www.xiao.xyz/admin/member-tree/' + id,
                            data: {
                                _method:'delete',
                                _token:LA.token,
                            },
                            success: function (data) {
                                $.pjax.reload('#pjax-container');
                                toastr.success('删除成功 !');
                                resolve(data);
                            }
                        });
                    });
                }
            }).then(function(result) {
                var data = result.value;
                if (typeof data === 'object') {
                    if (data.status) {
                        swal(data.message, '', 'success');
                    } else {
                        swal(data.message, '', 'error');
                    }
                }
            });
        });



        // $('.tree-67b457e81d3a3-save').click(function () {
        //     var serialize = $('#tree-67b457e81d3a3').nestable('serialize');
        //
        //     $.post('http://www.xiao.xyz/admin/member-tree', {
        //             _token: LA.token,
        //             _order: JSON.stringify(serialize)
        //         },
        //         function(data){
        //             $.pjax.reload('#pjax-container');
        //             toastr.success('保存成功 !');
        //         });
        // });
        //
        // $('.tree-67b457e81d3a3-refresh').click(function () {
        //     $.pjax.reload('#pjax-container');
        //     toastr.success('刷新成功 !');
        // });

        $('.tree-67b457e81d3a3-tree-tools').on('click', function(e){
            var action = $(this).data('action');
            if (action === 'expand') {

                $('.dd').nestablenew1('expandAll');
            }
            if (action === 'collapse') {
                $('.dd').nestablenew1('collapseAll');
            }
        });

        ;(function () {
            $('.container-refresh').off('click').on('click', function() {
                $.admin.reload();
                $.admin.toastr.success('刷新成功 !', '', {positionClass:"toast-top-center"});
            });
        })(); });</script>
<script>
    var hasTouch = 'ontouchstart' in document;


    var hasPointerEvents = (function()
    {
        var el    = document.createElement('div'),
            docEl = document.documentElement;
        if (!('pointerEvents' in el.style)) {
            return false;
        }
        el.style.pointerEvents = 'auto';
        el.style.pointerEvents = 'x';
        docEl.appendChild(el);
        var supports = window.getComputedStyle && window.getComputedStyle(el, '').pointerEvents === 'auto';
        docEl.removeChild(el);
        return !!supports;
    })();

    var defaults = {
        listNodeName    : 'ol',
        itemNodeName    : 'li',
        rootClass       : 'dd',
        listClass       : 'dd-list',
        itemClass       : 'dd-item',
        dragClass       : 'dd-dragel',
        handleClass     : 'dd-handle',
        collapsedClass  : 'dd-collapsed',
        placeClass      : 'dd-placeholder',
        noDragClass     : 'dd-nodrag',
        emptyClass      : 'dd-empty',
        expandGetBtnHTML   : '<button data-action="getexpand" type="button">Expand</button>',
        expandBtnHTML   : '<button data-action="expand" type="button">Expand</button>',
        collapseBtnHTML : '<button data-action="collapse" type="button">Collapse</button>',
        group           : 0,
        maxDepth        : 5,
        threshold       : 20
    };



    $.fn.nestablenew1 = function(params)
    {
        var lists  = this,
            retval = this;
        lists.each(function()
        {
            var plugin = $(this).data("nestable");

            if (!plugin) {
                $(this).data("nestable", new Pluginnew1(this, params));
                $(this).data("nestable-id", new Date().getTime());
            } else {
                if (typeof params === 'string' && typeof plugin[params] === 'function') {
                    console.log(params)
                    retval = plugin[params]();
                }
            }
        });

        return retval || lists;
    };
    function Pluginnew1(element, options)
    {
        this.w  = $(document);
        this.el = $(element);
        this.options = $.extend({}, defaults, options);

        this.init();
    }
    Pluginnew1.prototype = {

        init: function()
        {
            var list = this;

            list.reset();

            list.el.data('nestable-group', this.options.group);

            list.placeEl = $('<div class="' + list.options.placeClass + '"/>');

            $.each(this.el.find(list.options.itemNodeName), function(k, el) {
                list.setParent($(el));
            });

            list.el.on('click', 'button', function(e) {
                if (list.dragEl) {
                    return;
                }
                var target = $(e.currentTarget),
                    action = target.data('action'),
                    item   = target.parent(list.options.itemNodeName);
                if (action === 'collapse') {
                    list.collapseItem(item);
                }
                if (action === 'expand') {
                    list.expandItem(item);
                }
                if(action === 'getexpand'){
                    var id = target.data('id');
                    console.log(id);
                    list.expandgetData(item,id);
                }
            });

            var onStartEvent = function(e)
            {
                var handle = $(e.target);
                if (!handle.hasClass(list.options.handleClass)) {
                    if (handle.closest('.' + list.options.noDragClass).length) {
                        return;
                    }
                    handle = handle.closest('.' + list.options.handleClass);
                }

                if (!handle.length || list.dragEl) {
                    return;
                }

                list.isTouch = /^touch/.test(e.type);
                if (list.isTouch && e.touches.length !== 1) {
                    return;
                }

                e.preventDefault();
                list.dragStart(e.touches ? e.touches[0] : e);
            };

            var onMoveEvent = function(e)
            {
                if (list.dragEl) {
                    e.preventDefault();
                    list.dragMove(e.touches ? e.touches[0] : e);
                }
            };

            var onEndEvent = function(e)
            {
                if (list.dragEl) {
                    e.preventDefault();
                    list.dragStop(e.touches ? e.touches[0] : e);
                }
            };

            // if (hasTouch) {
            //     list.el[0].addEventListener('touchstart', onStartEvent, false);
            //     window.addEventListener('touchmove', onMoveEvent, false);
            //     window.addEventListener('touchend', onEndEvent, false);
            //     window.addEventListener('touchcancel', onEndEvent, false);
            // }

            // list.el.on('mousedown', onStartEvent);
            // list.w.on('mousemove', onMoveEvent);
            // list.w.on('mouseup', onEndEvent);

        },
        expandgetData: function(li,id)
        {
            var lists = li.children(this.options.listNodeName);
            var options = this.options;

            $.post('{{url('admin/treev2/get')}}', {
                        _token: LA.token,
                        id:id,
                    },
                    function(data){
                        console.log(id);
                        $.post('{{url('admin/treev2/get')}}', {
                                _token: LA.token,
                                id:id,
                            },
                            function(data){

                                li.children('[data-action="getexpand"]').hide();
                                li.prepend($(options.expandBtnHTML));
                                li.prepend($(options.collapseBtnHTML));
                                li.children('[data-action="expand"]').hide();
                                console.log(data);
                                if(data.code==0){
                                    var str = '';
                                    str = '<ol class="dd-list">';
                                    data.data.forEach(function (member) {

                                        str = str +'<li class="dd-item" data-id="' + member.id + '">';
                                        if(member.children.length){
                                            str = str +  '<button data-action="getexpand"  data-id="'+ member.id+'" type="button">Expand</button>';
                                        }
                                        str = str+  '<div class="dd-handle">' + member.id + ' - ' + member.number + ' - ' + member.real_name + ' -L' + member.level;
                                        str = str+  ' </ div></li> ';

                                    });

                                    str = str+  '</ol>';
                                    li.append(str);
                                }
                            });
                    });

            if (lists.length) {
                li.addClass(this.options.collapsedClass);
                li.children('[data-action="collapse"]').hide();
                li.children('[data-action="expand"]').show();
                li.children(this.options.listNodeName).hide();
            }

        },

        serialize: function()
        {
            var data,
                depth = 0,
                list  = this;
            step  = function(level, depth)
            {
                var array = [ ],
                    items = level.children(list.options.itemNodeName);
                items.each(function()
                {
                    var li   = $(this),
                        item = $.extend({}, li.data()),
                        sub  = li.children(list.options.listNodeName);
                    if (sub.length) {
                        item.children = step(sub, depth + 1);
                    }
                    array.push(item);
                });
                return array;
            };
            data = step(list.el.find(list.options.listNodeName).first(), depth);
            return data;
        },

        serialise: function()
        {
            return this.serialize();
        },

        reset: function()
        {
            this.mouse = {
                offsetX   : 0,
                offsetY   : 0,
                startX    : 0,
                startY    : 0,
                lastX     : 0,
                lastY     : 0,
                nowX      : 0,
                nowY      : 0,
                distX     : 0,
                distY     : 0,
                dirAx     : 0,
                dirX      : 0,
                dirY      : 0,
                lastDirX  : 0,
                lastDirY  : 0,
                distAxX   : 0,
                distAxY   : 0
            };
            this.isTouch    = false;
            this.moving     = false;
            this.dragEl     = null;
            this.dragRootEl = null;
            this.dragDepth  = 0;
            this.hasNewRoot = false;
            this.pointEl    = null;
        },

        expandItem: function(li)
        {
            li.removeClass(this.options.collapsedClass);
            li.children('[data-action="expand"]').hide();
            li.children('[data-action="collapse"]').show();
            li.children(this.options.listNodeName).show();
            if(li.children('nool').length){
                li.children('[data-action="getexpand"]').hide();
                li.prepend($(this.options.expandGetBtnHTML));
            }

        },

        collapseItem: function(li)
        {
            var lists = li.children(this.options.listNodeName);
            if (lists.length) {
                li.addClass(this.options.collapsedClass);
                li.children('[data-action="collapse"]').hide();
                li.children('[data-action="expand"]').show();
                li.children(this.options.listNodeName).hide();
            }
        },

        expandAll: function()
        {

            var list = this;
            list.el.find(list.options.itemNodeName).each(function() {
                list.expandItem($(this));
            });
        },

        collapseAll: function()
        {
            var list = this;
            list.el.find(list.options.itemNodeName).each(function() {
                list.collapseItem($(this));
            });
        },

        setParent: function(li)
        {
            console.log(li.children('ol').length)


            if (li.children(this.options.listNodeName).length) {
                li.prepend($(this.options.expandBtnHTML));
                li.prepend($(this.options.collapseBtnHTML));
            }

            li.children('[data-action="expand"]').hide();
            if(li.children('nool').length){
                li.prepend($(this.options.expandGetBtnHTML));
            }


        },

        unsetParent: function(li)
        {
            li.removeClass(this.options.collapsedClass);
            li.children('[data-action]').remove();
            li.children(this.options.listNodeName).remove();
        },

        dragStart: function(e)
        {
            var mouse    = this.mouse,
                target   = $(e.target),
                dragItem = target.closest(this.options.itemNodeName);

            this.placeEl.css('height', dragItem.height());

            mouse.offsetX = e.offsetX !== undefined ? e.offsetX : e.pageX - target.offset().left;
            mouse.offsetY = e.offsetY !== undefined ? e.offsetY : e.pageY - target.offset().top;
            mouse.startX = mouse.lastX = e.pageX;
            mouse.startY = mouse.lastY = e.pageY;

            this.dragRootEl = this.el;

            this.dragEl = $(document.createElement(this.options.listNodeName)).addClass(this.options.listClass + ' ' + this.options.dragClass);
            this.dragEl.css('width', dragItem.width());

            dragItem.after(this.placeEl);
            dragItem[0].parentNode.removeChild(dragItem[0]);
            dragItem.appendTo(this.dragEl);

            $(document.body).append(this.dragEl);
            this.dragEl.css({
                'left' : e.pageX - mouse.offsetX,
                'top'  : e.pageY - mouse.offsetY
            });
            // total depth of dragging item
            var i, depth,
                items = this.dragEl.find(this.options.itemNodeName);
            for (i = 0; i < items.length; i++) {
                depth = $(items[i]).parents(this.options.listNodeName).length;
                if (depth > this.dragDepth) {
                    this.dragDepth = depth;
                }
            }
        },

        dragStop: function(e)
        {
            var el = this.dragEl.children(this.options.itemNodeName).first();
            el[0].parentNode.removeChild(el[0]);
            this.placeEl.replaceWith(el);

            this.dragEl.remove();
            this.el.trigger('change');
            if (this.hasNewRoot) {
                this.dragRootEl.trigger('change');
            }
            this.reset();
        },

        dragMove: function(e)
        {
            var list, parent, prev, next, depth,
                opt   = this.options,
                mouse = this.mouse;

            this.dragEl.css({
                'left' : e.pageX - mouse.offsetX,
                'top'  : e.pageY - mouse.offsetY
            });

            // mouse position last events
            mouse.lastX = mouse.nowX;
            mouse.lastY = mouse.nowY;
            // mouse position this events
            mouse.nowX  = e.pageX;
            mouse.nowY  = e.pageY;
            // distance mouse moved between events
            mouse.distX = mouse.nowX - mouse.lastX;
            mouse.distY = mouse.nowY - mouse.lastY;
            // direction mouse was moving
            mouse.lastDirX = mouse.dirX;
            mouse.lastDirY = mouse.dirY;
            // direction mouse is now moving (on both axis)
            mouse.dirX = mouse.distX === 0 ? 0 : mouse.distX > 0 ? 1 : -1;
            mouse.dirY = mouse.distY === 0 ? 0 : mouse.distY > 0 ? 1 : -1;
            // axis mouse is now moving on
            var newAx   = Math.abs(mouse.distX) > Math.abs(mouse.distY) ? 1 : 0;

            // do nothing on first move
            if (!mouse.moving) {
                mouse.dirAx  = newAx;
                mouse.moving = true;
                return;
            }

            // calc distance moved on this axis (and direction)
            if (mouse.dirAx !== newAx) {
                mouse.distAxX = 0;
                mouse.distAxY = 0;
            } else {
                mouse.distAxX += Math.abs(mouse.distX);
                if (mouse.dirX !== 0 && mouse.dirX !== mouse.lastDirX) {
                    mouse.distAxX = 0;
                }
                mouse.distAxY += Math.abs(mouse.distY);
                if (mouse.dirY !== 0 && mouse.dirY !== mouse.lastDirY) {
                    mouse.distAxY = 0;
                }
            }
            mouse.dirAx = newAx;

            /**
             * move horizontal
             */
            if (mouse.dirAx && mouse.distAxX >= opt.threshold) {
                // reset move distance on x-axis for new phase
                mouse.distAxX = 0;
                prev = this.placeEl.prev(opt.itemNodeName);
                // increase horizontal level if previous sibling exists and is not collapsed
                if (mouse.distX > 0 && prev.length && !prev.hasClass(opt.collapsedClass)) {
                    // cannot increase level when item above is collapsed
                    list = prev.find(opt.listNodeName).last();
                    // check if depth limit has reached
                    depth = this.placeEl.parents(opt.listNodeName).length;
                    if (depth + this.dragDepth <= opt.maxDepth) {
                        // create new sub-level if one doesn't exist
                        if (!list.length) {
                            list = $('<' + opt.listNodeName + '/>').addClass(opt.listClass);
                            list.append(this.placeEl);
                            prev.append(list);
                            this.setParent(prev);
                        } else {
                            // else append to next level up
                            list = prev.children(opt.listNodeName).last();
                            list.append(this.placeEl);
                        }
                    }
                }
                // decrease horizontal level
                if (mouse.distX < 0) {
                    // we can't decrease a level if an item preceeds the current one
                    next = this.placeEl.next(opt.itemNodeName);
                    if (!next.length) {
                        parent = this.placeEl.parent();
                        this.placeEl.closest(opt.itemNodeName).after(this.placeEl);
                        if (!parent.children().length) {
                            this.unsetParent(parent.parent());
                        }
                    }
                }
            }

            var isEmpty = false;

            // find list item under cursor
            if (!hasPointerEvents) {
                this.dragEl[0].style.visibility = 'hidden';
            }
            this.pointEl = $(document.elementFromPoint(e.pageX - document.body.scrollLeft, e.pageY - (window.pageYOffset || document.documentElement.scrollTop)));
            if (!hasPointerEvents) {
                this.dragEl[0].style.visibility = 'visible';
            }
            if (this.pointEl.hasClass(opt.handleClass)) {
                this.pointEl = this.pointEl.parent(opt.itemNodeName);
            }
            if (this.pointEl.hasClass(opt.emptyClass)) {
                isEmpty = true;
            }
            else if (!this.pointEl.length || !this.pointEl.hasClass(opt.itemClass)) {
                return;
            }

            // find parent list of item under cursor
            var pointElRoot = this.pointEl.closest('.' + opt.rootClass),
                isNewRoot   = this.dragRootEl.data('nestable-id') !== pointElRoot.data('nestable-id');

            /**
             * move vertical
             */
            if (!mouse.dirAx || isNewRoot || isEmpty) {
                // check if groups match if dragging over new root
                if (isNewRoot && opt.group !== pointElRoot.data('nestable-group')) {
                    return;
                }
                // check depth limit
                depth = this.dragDepth - 1 + this.pointEl.parents(opt.listNodeName).length;
                if (depth > opt.maxDepth) {
                    return;
                }
                var before = e.pageY < (this.pointEl.offset().top + this.pointEl.height() / 2);
                parent = this.placeEl.parent();
                // if empty create new list to replace empty placeholder
                if (isEmpty) {
                    list = $(document.createElement(opt.listNodeName)).addClass(opt.listClass);
                    list.append(this.placeEl);
                    this.pointEl.replaceWith(list);
                }
                else if (before) {
                    this.pointEl.before(this.placeEl);
                }
                else {
                    this.pointEl.after(this.placeEl);
                }
                if (!parent.children().length) {
                    this.unsetParent(parent.parent());
                }
                if (!this.dragRootEl.find(opt.itemNodeName).length) {
                    this.dragRootEl.append('<div class="' + opt.emptyClass + '"/>');
                }
                // parent root list has changed
                if (isNewRoot) {
                    this.dragRootEl = pointElRoot;
                    this.hasNewRoot = this.el[0] !== this.dragRootEl[0];
                }
            }
        }

    };

</script>

