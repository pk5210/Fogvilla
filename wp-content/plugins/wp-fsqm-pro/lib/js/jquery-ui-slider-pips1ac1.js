/*! jQuery-ui-Slider-Pips - v1.11.1 - 2015-11-30
* Copyright (c) 2015 Simon Goellner <simey.me@gmail.com>; Licensed MIT */

!function(e){"use strict";var i={pips:function(i){function l(i){var l,s,t,a,n,r=[],o=0;if(u.values()&&u.values().length){for(t=u.values(),a=e.map(t,function(e){return Math.abs(e-i)}),n=Math.min.apply(Math,a),l=0;l<a.length;l++)a[l]===n&&r.push(l);for(o=r[0],s=0;s<r.length;s++)u._lastChangedValue===r[s]&&(o=r[s]);u.options.range&&2===r.length&&(i>t[1]?o=r[1]:i<t[0]&&(o=r[0]))}return o}function s(){u.element.off(".selectPip").on("mousedown.slider",u.element.data("mousedown-original")).removeClass("ui-slider-pips").find(".ui-slider-pip").remove()}function t(i,s){if(!u.option("disabled")){var t=e(i).data("value"),a=l(t);u.values()&&u.values().length?u.options.values[a]=u._trimAlignValue(t):u.options.value=u._trimAlignValue(t),u._refreshValue(),u._change(s,a)}}function a(i){var l,s,t=i,a="ui-slider-pip",r="",o=u.value(),d=u.values();"first"===i?t=0:"last"===i&&(t=h);var p=v+u.options.step*t,f=p.toString().replace(".","-");if(l="array"===e.type(g.labels)?g.labels[t]||"":"object"===e.type(g.labels)?"first"===i?g.labels.first||"":"last"===i?g.labels.last||"":"array"===e.type(g.labels.rest)?g.labels.rest[t-1]||"":p:p,"first"===i?(s="0%",a+=" ui-slider-pip-first",a+="label"===g.first?" ui-slider-pip-label":"",a+=g.first===!1?" ui-slider-pip-hide":""):"last"===i?(s="100%",a+=" ui-slider-pip-last",a+="label"===g.last?" ui-slider-pip-label":"",a+=g.last===!1?" ui-slider-pip-hide":""):(s=(100/h*i).toFixed(4)+"%",a+="label"===g.rest?" ui-slider-pip-label":"",a+=g.rest===!1?" ui-slider-pip-hide":""),a+=" ui-slider-pip-"+f,d&&d.length){for(n=0;n<d.length;n++)p===d[n]&&(a+=" ui-slider-pip-initial-"+(n+1),a+=" ui-slider-pip-selected-"+(n+1));u.options.range&&p>d[0]&&p<d[1]&&(a+=" ui-slider-pip-inrange")}else p===o&&(a+=" ui-slider-pip-initial",a+=" ui-slider-pip-selected"),u.options.range&&("min"===u.options.range&&o>p||"max"===u.options.range&&p>o)&&(a+=" ui-slider-pip-inrange");return r="horizontal"===u.options.orientation?"left: "+s:"bottom: "+s,'<span class="'+a+'" style="'+r+'"><span class="ui-slider-line"></span><span class="ui-slider-label" data-value="'+p+'">'+g.formatLabel(l)+"</span></span>"}var n,r,o,d,p,u=this,f="",v=u._valueMin(),c=u._valueMax(),h=(c-v)/u.options.step,m=u.element.find(".ui-slider-handle"),g={first:"label",last:"label",rest:"pip",labels:!1,prefix:"",suffix:"",step:h>100?Math.floor(.05*h):1,formatLabel:function(e){return this.prefix+e+this.suffix}};if("object"!==e.type(i)&&"undefined"!==e.type(i))return void("destroy"===i?s():"refresh"===i&&u.element.slider("pips",u.element.data("pips-options")));e.extend(g,i),u.element.data("pips-options",g),u.options.pipStep=Math.round(g.step),u.element.off(".selectPip").addClass("ui-slider-pips").find(".ui-slider-pip").remove();var b={single:function(i){this.resetClasses(),p.filter(".ui-slider-pip-"+this.classLabel(i)).addClass("ui-slider-pip-selected"),u.options.range&&p.each(function(l,s){var t=e(s).children(".ui-slider-label").data("value");("min"===u.options.range&&i>t||"max"===u.options.range&&t>i)&&e(s).addClass("ui-slider-pip-inrange")})},range:function(i){for(this.resetClasses(),n=0;n<i.length;n++)p.filter(".ui-slider-pip-"+this.classLabel(i[n])).addClass("ui-slider-pip-selected-"+(n+1));u.options.range&&p.each(function(l,s){var t=e(s).children(".ui-slider-label").data("value");t>i[0]&&t<i[1]&&e(s).addClass("ui-slider-pip-inrange")})},classLabel:function(e){return e.toString().replace(".","-")},resetClasses:function(){var e=/(^|\s*)(ui-slider-pip-selected|ui-slider-pip-inrange)(-{1,2}\d+|\s|$)/gi;p.removeClass(function(i,l){return(l.match(e)||[]).join(" ")})}};for(f+=a("first"),o=1;h>o;o++)o%u.options.pipStep===0&&(f+=a(o));for(f+=a("last"),u.element.append(f),p=u.element.find(".ui-slider-pip"),d=e._data(u.element.get(0),"events").mousedown&&e._data(u.element.get(0),"events").mousedown.length?e._data(u.element.get(0),"events").mousedown:u.element.data("mousedown-handlers"),u.element.data("mousedown-handlers",d.slice()),r=0;r<d.length;r++)"slider"===d[r].namespace&&u.element.data("mousedown-original",d[r].handler);u.element.off("mousedown.slider").on("mousedown.selectPip",function(i){var s=e(i.target),a=l(s.data("value")),n=m.eq(a);if(n.addClass("ui-state-active"),s.is(".ui-slider-label"))t(s,i),u.element.one("mouseup.selectPip",function(){n.removeClass("ui-state-active").focus()});else{var r=u.element.data("mousedown-original");r(i)}}),u.element.on("slide.selectPip slidechange.selectPip",function(i,l){var s=e(this),t=s.slider("value"),a=s.slider("values");l&&(t=l.value,a=l.values),u.values()&&u.values().length?b.range(a):b.single(t)})},"float":function(i){function l(){a.element.off(".sliderFloat").removeClass("ui-slider-float").find(".ui-slider-tip, .ui-slider-tip-label").remove()}function s(i){var l=[],s=e.map(i,function(e){return Math.ceil((e-n)/a.options.step)});if("array"===e.type(f.labels))for(t=0;t<i.length;t++)l[t]=f.labels[s[t]]||i[t];else if("object"===e.type(f.labels))for(t=0;t<i.length;t++)i[t]===n?l[t]=f.labels.first||n:i[t]===r?l[t]=f.labels.last||r:"array"===e.type(f.labels.rest)?l[t]=f.labels.rest[s[t]-1]||i[t]:l[t]=i[t];else for(t=0;t<i.length;t++)l[t]=i[t];return l}var t,a=this,n=a._valueMin(),r=a._valueMax(),o=a._value(),d=a._values(),p=[],u=a.element.find(".ui-slider-handle"),f={handle:!0,pips:!1,labels:!1,prefix:"",suffix:"",event:"slidechange slide",formatLabel:function(e){return this.prefix+e+this.suffix}};if("object"!==e.type(i)&&"undefined"!==e.type(i))return void("destroy"===i?l():"refresh"===i&&a.element.slider("float",a.element.data("float-options")));if(e.extend(f,i),a.element.data("float-options",f),n>o&&(o=n),o>r&&(o=r),d&&d.length)for(t=0;t<d.length;t++)d[t]<n&&(d[t]=n),d[t]>r&&(d[t]=r);if(a.element.addClass("ui-slider-float").find(".ui-slider-tip, .ui-slider-tip-label").remove(),f.handle)for(p=s(a.values()&&a.values().length?d:[o]),t=0;t<p.length;t++)u.eq(t).append(e('<span class="ui-slider-tip">'+f.formatLabel(p[t])+"</span>"));f.pips&&a.element.find(".ui-slider-label").each(function(i,l){var t,a,n=e(l),r=[n.data("value")];t=f.formatLabel(s(r)[0]),a=e('<span class="ui-slider-tip-label">'+t+"</span>").insertAfter(n)}),"slide"!==f.event&&"slidechange"!==f.event&&"slide slidechange"!==f.event&&"slidechange slide"!==f.event&&(f.event="slidechange slide"),a.element.off(".sliderFloat").on(f.event+".sliderFloat",function(i,l){var t="array"===e.type(l.value)?l.value:[l.value],a=f.formatLabel(s(t)[0]);e(l.handle).find(".ui-slider-tip").html(a)})}};e.extend(!0,e.ui.slider.prototype,i)}(jQuery);