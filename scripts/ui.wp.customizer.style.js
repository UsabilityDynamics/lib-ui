jQuery(document).ready(function(){function a(){if(!jQuery("#udx-style-preview-container").length){var a=jQuery('<style type="text/css" id="udx-style-preview-container"></style>');jQuery("head").append(a)}}function b(a){jQuery("head #udx-style-preview-container").text(a)}wp.customize("custom-style",function(c){var d;a(),c.bind(function(a){window.clearTimeout(d),d=window.setTimeout(function(){b(a)},200)})}),wp.customize("custom-style-minify",function(){})});