import{_ as e,c as t,o as s,a,w as l,b as i,n,d as r,t as c,e as o,i as d,u as m,r as u,f as h,s as p,g as f,h as g,j as A,F as R,k as y,l as L,m as x}from"./index-Cu6ZRL8P.js";import{i as _}from"./index.D1PJ-MWz.js";import{o as b}from"./uni-app.es.HQMdbc2N.js";import{p as w}from"./question.CRoMSd5f.js";import"./request.Cdi9Y7TV.js";const S=""+new URL("banner-yt2zpK79.png",import.meta.url).href;const v=e({props:{options:{type:Object,default:function(){return{direction:"left",step:2,hoverStop:!1}}},imageList:{type:String},typeColor:{type:String}},watch:{imageList(){this.stopScroll(),this.init(),console.log("change")}},data:()=>({seamLessRect:{},scrollPanelRect:{},realRect:0,marginTop:0,marginLeft:0,timer:null,needSlot:!0,needNowrap:!0}),mounted(){this.$nextTick((async()=>{console.log("init"),this.init()}))},methods:{async setRectWidth(e){return new Promise(((s,a)=>{t().in(this).select(e).boundingClientRect().exec((e=>{s(e[0].width)}))}))},init(){setTimeout((async()=>{this.seamLessRect=await this.setRectWidth("#scrollSeamless"),this.scrollPanelRect=await this.setRectWidth("#scrollPanel"),this.realRect=await this.setRectWidth("#realRect"),console.log(this.seamLessRect>this.realRect,this.realRect,this.seamLessRect),this.seamLessRect>this.realRect?this.needSlot=!1:this.scrollLeft()}),0)},scrollLeft(){this.timer=setInterval((()=>{this.marginLeft=this.marginLeft-this.options.step,Math.abs(this.marginLeft)>=this.realRect&&(this.marginLeft=0)}),50)},stopScroll(){this.options.hoverStop&&null!=this.timer&&clearInterval(this.timer)}}},[["render",function(e,t,m,u,h,p){const f=d;return s(),a(f,{ref:"scrollSeamless",id:"scrollSeamless",class:"scroll-seamless"},{default:l((()=>[i(f,{ref:"scrollPanel",id:"scrollPanel",class:"scroll-seamless-panel",style:n({marginTop:h.marginTop+"px",marginLeft:h.marginLeft+"px",whiteSpace:"nowrap"})},{default:l((()=>[i(f,{ref:"realRect",id:"realRect",style:{display:"inline-block"}},{default:l((()=>[i(f,{class:"goods-name line-clamp-1",style:n(m.typeColor)},{default:l((()=>[r(c(m.imageList),1)])),_:1},8,["style"])])),_:1},512),h.needSlot?(s(),a(f,{key:0,style:{display:"inline-block"}},{default:l((()=>[i(f,{class:"goods-name line-clamp-1",style:n(m.typeColor)},{default:l((()=>[r(c(m.imageList),1)])),_:1},8,["style"])])),_:1})):o("",!0)])),_:1},8,["style"])])),_:1},512)}],["__scopeId","data-v-3da72e6b"]]),B=e({__name:"index",setup(e){const{t:t}=m(),n=u({});h({day_integral:"",integral:"",month_pv:"",pv:""}),b((()=>{for(let e of[1,2,3])p({index:e-1,text:t(`menu.menu${e}`)});f({title:t("index.title")}),C()}));const B=h([{name:t("index.menu0"),damta:"2200",unit:t("index.unit")},{name:t("index.menu1"),data:"2200",unit:t("index.unit")},{name:t("index.menu2"),data:"2200",unit:t("index.unit")},{name:t("index.menu3"),data:"2200",unit:t("index.unit")}]),C=()=>{_().then((({data:e})=>{B[0].data=e.day_integral,B[1].data=e.month_pv,B[2].data=e.integral,B[3].data=e.pv})),w().then((({data:e})=>{console.log("proclamationList",e),e.length&&(n.value=e[0])}))};return(e,t)=>{const m=y,u=d,h=x;return s(),a(u,null,{default:l((()=>[i(u,{class:"banner"},{default:l((()=>[i(m,{class:"image",src:S})])),_:1}),n.value.title?(s(),a(u,{key:0,class:"notice flex-start-center-nowrap",onClick:t[0]||(t[0]=t=>e.toUrl("/pages/notice/list"))},{default:l((()=>[i(u,{class:"icon"},{default:l((()=>[i(m,{class:"image",src:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAeRJREFUSEu1lcFLFFEcx7/fcRNBIcJm7WJYeYgOIZ0UEhbNbrVvvAazg3bSrkGBB1OD/oFQD4I7Cx3bqVsbXfMcGV6kzs3sXiylwJ1fjLDDrLtuzu7OO7/3/bzv7/1+30ckvJiwPtoB0Mx686SsCfD7WJP7b94OfT/rorEAj7KVWz2sbpK8WxMUwbLt6C86AlgZ6ZNLlSWBPCXQGxUTyCu7mH7eNsDMlu+B/jrJ0WYiUYCl3LFtJ/0FgNT2hiUyjYNByJ8Vktcj9gdIhOVoBQjKl9L8b74vTwrv0q8bAcr7RGIqbldFHZjK/QDgjhz5I4XSlcNAK+LAOybQ0wnAmq2Mi/g7EHmcd9JbdYCc4YV1iwM5/cg55e4LuWsXdZUIwFSeTSCTd/SriQByqrwqkGe2o19IBmCU104ART2VCMA03G2A03ZRH04EkDPcfRHu2k7jI1cBaHE6KNhbNwdGZYLwPzdvU+WWQM50BFDeR0DG5EgfKZR4etAOBil/V0FcCyGCfhCTraA1B9aD8k1JyR6EC3nn8npDVJwlEoQd6W+AvPG/sDMf/rxtvx/62jTsWt3Syvzok4v9S6Kx+3EdBZ8kJquBm7BsXflw6t0ta2Z2cQ6UlwB+dfXLjNthdYPWzuHznPkHe5cAKBho2l0AAAAASUVORK5CYII="})])),_:1}),i(u,{class:"scroll-item flex-1"},{default:l((()=>[i(v,{imageList:n.value.title},null,8,["imageList"])])),_:1})])),_:1})):o("",!0),i(u,{class:"grid-2"},{default:l((()=>[(s(!0),g(R,null,A(B,((e,t)=>(s(),a(u,{class:"item",key:e.name},{default:l((()=>[i(u,{class:"title"},{default:l((()=>[r(c(e.name),1)])),_:2},1024),i(u,{class:L(["data",{blue:2==t,red:0==t}])},{default:l((()=>[r(c(e.data)+" ",1),i(h,{class:"unit"},{default:l((()=>[r(c(e.unit),1)])),_:2},1024)])),_:2},1032,["class"]),i(m,{class:"icon",src:`/static/index/menu${t+1}.png`},null,8,["src"])])),_:2},1024)))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-6fa6dad7"]]);export{B as default};
