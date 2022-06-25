(function () {
    /**
     * MessageBox
     */
    let MessageBox = {
        alert: alert,
        confirm: confirm,
        show: show
    };

    /**
     * Functions
     */
    function alert(config) {
        if ("string" == typeof config) {
            config = {message: config};
        }

        // default options
        let options = $.extend({
            title: "",
            message: "",
            btn_ok: "OK",
            callback: null
        }, config);

        // id
        options.id = options.id || "msg-modal-1";

        // template
        let tpl = options.tpl || null;
        if (tpl == null) {
            tpl = [
                '<div class="modal" tabindex="-1" role="dialog" data-backdrop="static" id="{{id}}" style="z-index:10000000">',
                '<div class="modal-dialog modal-dialog-centered" role="document" style="max-width:450px;">',
                '<div class="modal-content">',
                (options.title !== "" ?
                    [
                        '<div class="modal-header">',
                        '<h5 class="modal-title">{{title}}</h5>',
                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                        '</div>'
                    ].join("\n") : ""),
                '<div class="modal-body">{{message}}</div>',
                '<div class="modal-footer">',
                '<button type="button" class="btn btn-primary" data-dismiss="modal">{{btn_ok}}</button>',
                '</div>',
                '</div>',
                '</div>',
                '</div>'
            ].join("\n");
        }

        // apply options to template
        let reg;
        for (let k in options) {
            reg = new RegExp("{{" + k + "}}", "gi");
            tpl = tpl.replace(reg, options[k]);
        }

        // append to document
        let $modal = $("#" + options.id);
        if ($modal.length === 0) {
            $(document.body).append(tpl);
            $modal = $("#" + options.id);
        }

        // call callback
        $modal.on("hidden.bs.modal", function () {
            if ("function" == typeof options.callback) {
                options.callback.call(this, $modal);
            }

            $modal.remove();
        });

        // show modal
        $modal.modal('show');
    }

    function confirm(config, callback) {
        if ("string" == typeof config) {
            config = {message: config};
        }

        if("function" == typeof callback) {
            config.callback = callback;
        }

        // default options
        let options = $.extend({
            title: "",
            message: "",
            btn_ok: "OK",
            btn_cancel: "Cancel",
            autohide: true,
            callback: null
        }, config);

        // id
        options.id = options.id || "msg-modal-2";

        // template
        let tpl = options.tpl || null;
        if (tpl == null) {
            tpl = [
                '<div class="modal" tabindex="-1" role="dialog" data-backdrop="static" id="{{id}}" style="z-index:10000000">',
                '<div class="modal-dialog modal-dialog-centered" role="document" style="max-width:450px;">',
                '<div class="modal-content">',
                (options.title !== "" ? [
                        '<div class="modal-header">',
                        '<h5 class="modal-title">{{title}}</h5>',
                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                        '</div>'
                    ].join("\n") : ""),
                '<div class="modal-body">{{message}}</div>',
                '<div class="modal-footer">',
                '<button type="button" class="btn btn-secondary" data-value="N">{{btn_cancel}}</button>',
                '<button type="button" class="btn btn-primary" data-value="Y">{{btn_ok}}</button>',
                '</div>',
                '</div>',
                '</div>',
                '</div>'
            ].join("\n");
        }

        // apply options to template
        let reg;
        for (let k in options) {
            reg = new RegExp("{{" + k + "}}", "gi");
            tpl = tpl.replace(reg, options[k]);
        }

        // append to document
        let $modal = $("#" + options.id);
        if ($modal.length === 0) {
            $(document.body).append(tpl);
            $modal = $("#" + options.id);
        }

        // call callback
        $modal.skipHiddenListener = false;
        $modal.on("shown.bs.modal", function () {
            $modal
                .find(".modal-footer > button")
                .unbind("click")
                .bind("click", function () {
                    if ("function" == typeof options.callback) {
                        options.callback.call(this, $(this).data("value"), $modal);
                    }

                    if (options.autohide) {
                        $modal.skipHiddenListener = true;
                        $modal.modal('hide');
                    }
                });
        });
        $modal.on("hidden.bs.modal", function () {
            if ("function" == typeof options.callback && !$modal.skipHiddenListener) {
                options.callback.call(this, 'N', $modal);
            }

            $modal.remove();
        });

        // show modal
        $modal.modal('show');
    }

    function show(config) {
        // default options
        let options = $.extend({
            autofocus: true,
            autohide: true,
            callback: null,
            title: null,
            template: "",
            buttons: null,
            close_button: true,
            close_action: 'destroy'
        }, config);

        // id
        options.id = options.id || "msg-modal-2";

        // template
        let tpl = [
            '<div class="modal" tabindex="-1" role="dialog" data-backdrop="static" id="{{id}}">',
            '<div class="modal-dialog">',
            '<div class="modal-content">',
            '{{template}}',
            '</div>',
            '</div>',
            '</div>'
        ].join("\n");

        // parse template
        if ("object" == typeof options.template && "function" == typeof options.template.html) {
            options.template = options.template.html();
        }

        // apply options to template
        let reg;
        for (let k in options) {
            if (/(string|int)/i.test(typeof options[k])) {
                reg = new RegExp("{{" + k + "}}", "gi");
                tpl = tpl.replace(reg, options[k]);
            }
        }

        // append to document
        let $modal = $("#" + options.id);
        if ($modal.length == 0) {
            $(document.body).append(tpl);
            $modal = $("#" + options.id);
        }

        // apply title
        if (options.title != null) {
            $modal_container = $modal.find(".modal-content");

            let title = [
                '<div class="modal-header">',
                (options.close_button ? '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' : ''),
                '<h4 class="modal-title">' + options.title + '</h4>',
                '</div>'
            ].join("");

            // wrap previous modal content
            let prev_content = $modal_container.html();

            // apply title
            $modal_container.html(title);

            // restore prev content
            $modal_container.append('<div class="modal-body">' + prev_content + '</div>');
        } else if (!options.title && options.close_button) {
            $modal.find(".modal-content").append('<button type="button" class="close msg-close-button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        }

        // apply buttons
        if (options.buttons != null) {
            $modal_container = $modal.find(".modal-content");

            // detect modal-body,
            // wrap prev content into modal-body
            if ($modal_container.find(".modal-body").length <= 0) {
                let prev_content = $modal_container.html();
                $modal_container.html('<div class="modal-body">' + prev_content + '</div>');
            }

            // apply buttons
            let tpl = [], btn_class;
            for (let i = 0; i < options.buttons.length; i++) {
                btn_class = options.buttons[i].className || "btn-default";

                tpl[i] = [
                    '<button type="button" class="btn msg-button ' + btn_class + '" data-index="' + i + '">',
                    options.buttons[i].text,
                    '</button>'
                ].join("");
            }
            $modal_container.append('<div class="modal-footer">' + tpl.join("") + '</div>');
        }

        // apply style
        let style = {};
        if ("object" == typeof options.style) {
            style = $.extend(style, options.style);
        } else if ("string" == typeof options.style) {
            if (options.style.indexOf(";") != -1) {
                let items = options.style.split(";"),
                    item, key, val;
                for (let i = 0; i < items.length; i++) {
                    item = items[i].split(":");
                    key = $.trim(item[0]);
                    val = $.trim(item[1]);
                    if (key && val) {
                        style[key] = val
                    }
                }
            } else {
                let item, key, val;
                item = options.style.split(":");
                key = $.trim(item[0]);
                val = $.trim(item[1]);
                if (key && val) {
                    style[key] = val
                }
            }
        }

        // apply style to modal-dialog
        $modal.find(".modal-dialog").css(style);

        // call callback
        $modal.skipHiddenListener = false;
        $modal.on("shown.bs.modal", function () {
            // set focus for first element
            if (options.autofocus) {
                let $input = $modal.find("input[type=text],input[type=email],input[type=password],textarea").filter(':visible:first');
                if ($input.length > 0) {
                    $input.focus();
                }
            }

            $modal
                .find(".msg-button")
                .unbind("click")
                .bind("click", function () {
                    // get handler
                    let $btn = $(this),
                        btn_index = $btn.attr("data-index"),
                        handler = options.buttons[btn_index].handler || null;

                    if ("function" == typeof handler) {
                        $modal.skipHiddenListener = true;
                        handler.call(this, $btn, $modal);
                    }

                    if (options.autohide) {
                        $modal.skipHiddenListener = true;
                        $modal.modal('hide');
                    }
                });

            // on shown event
            if ("function" == typeof options.onShown) {
                options.onShown.call(this, $modal);
            }
        });
        $modal.on("hidden.bs.modal", function () {
            if ("function" == typeof options.callback && !$modal.skipHiddenListener) {
                options.callback.call(this, 'N', $modal);
            }

            if (options.close_action === 'destroy') {
                $modal.remove();
            }
        });

        // show modal
        $modal.modal('show');
    }

    /**
     * Alias
     */
    window.Msg = window.MessageBox = MessageBox;
})();
