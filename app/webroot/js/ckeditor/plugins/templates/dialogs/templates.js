﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function(){
    var a=CKEDITOR.document;
    CKEDITOR.dialog.add('templates',function(b){
        function c(i,j){
            i.setHtml('');
            for(var k=0;k<j.length;k++){
                var l=CKEDITOR.getTemplates(j[k]),m=l.imagesPath,n=l.templates,o=n.length;
                for(var p=0;p<o;p++){
                    var q=n[p],r=d(q,m);
                    r.setAttribute('aria-posinset',p+1);
                    r.setAttribute('aria-setsize',o);
                    i.append(r);
                }
                }
            };

    function d(i,j){
        var k=CKEDITOR.dom.element.createFromHtml('<a href="javascript:void(0)" tabIndex="-1" role="option" ><div class="cke_tpl_item"></div></a>'),l='<table style="width:350px; height:365px;" class="cke_tpl_preview" role="presentation"><tr>';
        if(i.image&&j)l+='<td class="cke_tpl_preview_img"><img src="'+CKEDITOR.getUrl(j+i.image)+'"'+(CKEDITOR.env.ie6Compat?' onload="this.width=this.width"':'')+' alt="" title=""></td></tr>';
        l+='<tr><td style="white-space:normal;"><span class="cke_tpl_title">'+i.title+'</span><br/>';
        if(i.description)l+='<span>'+i.description+'</span>';
        l+='</td></tr></table>';
        k.getFirst().setHtml(l);
        k.on('click',function(){
            e(i.html);
        });
        return k;
    };

    function e(i){
        var j=CKEDITOR.dialog.getCurrent(),k=j.getValueOf('selectTpl','chkInsertOpt');
        if(k){
            b.on('contentDom',function(l){
                l.removeListener();
                j.hide();
                var m=new CKEDITOR.dom.range(b.document);
                m.moveToElementEditStart(b.document.getBody());
                m.select(true);
                setTimeout(function(){
                    b.fire('saveSnapshot');
                },0);
            });
            b.fire('saveSnapshot');
            b.setData(i);
        }else{
            b.insertHtml(i);
            j.hide();
        }
    };

function f(i){
    var j=i.data.getTarget(),k=g.equals(j);
    if(k||g.contains(j)){
        var l=i.data.getKeystroke(),m=g.getElementsByTag('a'),n;
        if(m){
            if(k)n=m.getItem(0);else switch(l){
                case 40:
                    n=j.getNext();
                    break;
                case 38:
                    n=j.getPrevious();
                    break;
                case 13:case 32:
                    j.fire('click');
            }
            if(n){
                n.focus();
                i.data.preventDefault();
            }
        }
    }
};

CKEDITOR.skins.load(b,'templates');
var g,h='cke_tpl_list_label_'+CKEDITOR.tools.getNextNumber();
return{
    title:b.lang.templates.title,
    minWidth:CKEDITOR.env.ie?440:400,
    minHeight:340,
    contents:[{
        id:'selectTpl',
        label:b.lang.templates.title,
        elements:[{
            type:'vbox',
            padding:5,
            children:[{
                type:'html',
                html:'<span>'+b.lang.templates.selectPromptMsg+'</span>'
                },{
                id:'templatesList',
                type:'html',
                focus:true,
                html:'<div class="cke_tpl_list" tabIndex="-1" role="listbox" aria-labelledby="'+h+'">'+'<div class="cke_tpl_loading"><span></span></div>'+'</div>'+'<span class="cke_voice_label" id="'+h+'">'+b.lang.templates.options+'</span>'
                },{
                id:'chkInsertOpt',
                type:'checkbox',
                label:b.lang.templates.insertOption,
                'default':b.config.templates_replaceContent
                }]
            }]
        }],
    buttons:[CKEDITOR.dialog.cancelButton],
    onShow:function(){
        var i=this.getContentElement('selectTpl','templatesList');
        g=i.getElement();
        CKEDITOR.loadTemplates(b.config.templates_files,function(){
            var j=b.config.templates.split(',');
            if(j.length){
                c(g,j);
                i.focus();
            }else g.setHtml('<div class="cke_tpl_empty"><span>'+b.lang.templates.emptyListMsg+'</span>'+'</div>');
        });
        this._.element.on('keydown',f);
    },
    onHide:function(){
        this._.element.removeListener('keydown',f);
    }
};

});
})();
