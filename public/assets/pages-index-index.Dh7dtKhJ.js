import{_ as e,c as t,o as s,a,w as l,b as i,n,d as r,t as c,e as o,i as d,u as m,r as u,f as g,s as p,g as f,h,j as A,F as S,k as L,l as R,m as y}from"./index-MKzmdIaW.js";import{i as x}from"./index.C1ZKSikV.js";import{o as v}from"./uni-app.es.C6k1Vh9-.js";import{p as w}from"./question.HLnCA06K.js";import"./request.1IdGBK_9.js";const _=""+new URL("banner-yt2zpK79.png",import.meta.url).href;const b=e({props:{options:{type:Object,default:function(){return{direction:"left",step:2,hoverStop:!1}}},imageList:{type:String},typeColor:{type:String}},watch:{imageList(){this.stopScroll(),this.init(),console.log("change")}},data:()=>({seamLessRect:{},scrollPanelRect:{},realRect:0,marginTop:0,marginLeft:0,timer:null,needSlot:!0,needNowrap:!0}),mounted(){this.$nextTick((async()=>{console.log("init"),this.init()}))},methods:{async setRectWidth(e){return new Promise(((s,a)=>{t().in(this).select(e).boundingClientRect().exec((e=>{s(e[0].width)}))}))},init(){setTimeout((async()=>{this.seamLessRect=await this.setRectWidth("#scrollSeamless"),this.scrollPanelRect=await this.setRectWidth("#scrollPanel"),this.realRect=await this.setRectWidth("#realRect"),console.log(this.seamLessRect>this.realRect,this.realRect,this.seamLessRect),this.seamLessRect>this.realRect?this.needSlot=!1:this.scrollLeft()}),0)},scrollLeft(){this.timer=setInterval((()=>{this.marginLeft=this.marginLeft-this.options.step,Math.abs(this.marginLeft)>=this.realRect&&(this.marginLeft=0)}),50)},stopScroll(){this.options.hoverStop&&null!=this.timer&&clearInterval(this.timer)}}},[["render",function(e,t,m,u,g,p){const f=d;return s(),a(f,{ref:"scrollSeamless",id:"scrollSeamless",class:"scroll-seamless"},{default:l((()=>[i(f,{ref:"scrollPanel",id:"scrollPanel",class:"scroll-seamless-panel",style:n({marginTop:g.marginTop+"px",marginLeft:g.marginLeft+"px",whiteSpace:"nowrap"})},{default:l((()=>[i(f,{ref:"realRect",id:"realRect",style:{display:"inline-block"}},{default:l((()=>[i(f,{class:"goods-name line-clamp-1",style:n(m.typeColor)},{default:l((()=>[r(c(m.imageList),1)])),_:1},8,["style"])])),_:1},512),g.needSlot?(s(),a(f,{key:0,style:{display:"inline-block"}},{default:l((()=>[i(f,{class:"goods-name line-clamp-1",style:n(m.typeColor)},{default:l((()=>[r(c(m.imageList),1)])),_:1},8,["style"])])),_:1})):o("",!0)])),_:1},8,["style"])])),_:1},512)}],["__scopeId","data-v-3da72e6b"]]),B=e({__name:"index",setup(e){const{t:t}=m(),n=u({}),B=u(""),C=u("");g({day_integral:"",integral:"",month_pv:"",pv:""}),v((()=>{for(let s of[1,2,3])p({index:s-1,text:t(`menu.menu${s}`)});f({title:t("index.title")}),I();const e=j();B.value=D(e),C.value=setInterval((()=>{const e=j();B.value=D(e)}),6e4)}));const k=g([{name:t("index.menu0"),damta:"2200",unit:t("index.unit")},{name:t("index.menu1"),data:"2200",unit:t("index.unit")},{name:t("index.menu2"),data:"2200",unit:t("index.unit")},{name:t("index.menu3"),data:"2200",unit:t("index.unit")}]),j=()=>{const e=new Date,t=e.getTime()+6e4*e.getTimezoneOffset();return new Date(t+288e5)},D=e=>{const s=e.getFullYear(),a=String(e.getMonth()+1).padStart(2,"0"),l=String(e.getDate()).padStart(2,"0"),i=String(e.getHours()).padStart(2,"0"),n=String(e.getMinutes()).padStart(2,"0");String(e.getSeconds()).padStart(2,"0");return`${t("index.chinesetime")}：${s}/${a}/${l} ${i}:${n}`},I=()=>{x().then((({data:e})=>{k[0].data=e.day_integral,k[1].data=e.month_pv,k[2].data=e.integral,k[3].data=e.pv})),w().then((({data:e})=>{console.log("proclamationList",e),e.length&&(n.value=e[0])}))};return(e,t)=>{const m=L,u=d,g=y;return s(),a(u,null,{default:l((()=>[i(u,{class:"banner"},{default:l((()=>[i(m,{class:"image",src:_})])),_:1}),n.value.title?(s(),a(u,{key:0,class:"notice flex-start-center-nowrap",onClick:t[0]||(t[0]=t=>e.toUrl("/pages/notice/list"))},{default:l((()=>[i(u,{class:"icon"},{default:l((()=>[i(m,{class:"image",src:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAeRJREFUSEu1lcFLFFEcx7/fcRNBIcJm7WJYeYgOIZ0UEhbNbrVvvAazg3bSrkGBB1OD/oFQD4I7Cx3bqVsbXfMcGV6kzs3sXiylwJ1fjLDDrLtuzu7OO7/3/bzv7/1+30ckvJiwPtoB0Mx686SsCfD7WJP7b94OfT/rorEAj7KVWz2sbpK8WxMUwbLt6C86AlgZ6ZNLlSWBPCXQGxUTyCu7mH7eNsDMlu+B/jrJ0WYiUYCl3LFtJ/0FgNT2hiUyjYNByJ8Vktcj9gdIhOVoBQjKl9L8b74vTwrv0q8bAcr7RGIqbldFHZjK/QDgjhz5I4XSlcNAK+LAOybQ0wnAmq2Mi/g7EHmcd9JbdYCc4YV1iwM5/cg55e4LuWsXdZUIwFSeTSCTd/SriQByqrwqkGe2o19IBmCU104ART2VCMA03G2A03ZRH04EkDPcfRHu2k7jI1cBaHE6KNhbNwdGZYLwPzdvU+WWQM50BFDeR0DG5EgfKZR4etAOBil/V0FcCyGCfhCTraA1B9aD8k1JyR6EC3nn8npDVJwlEoQd6W+AvPG/sDMf/rxtvx/62jTsWt3Syvzok4v9S6Kx+3EdBZ8kJquBm7BsXflw6t0ta2Z2cQ6UlwB+dfXLjNthdYPWzuHznPkHe5cAKBho2l0AAAAASUVORK5CYII="})])),_:1}),i(u,{class:"scroll-item flex-1"},{default:l((()=>[i(b,{imageList:n.value.title},null,8,["imageList"])])),_:1})])),_:1})):o("",!0),i(u,{class:"notice flex-start-center-nowrap"},{default:l((()=>[i(u,{class:"scroll-item flex-1"},{default:l((()=>[i(b,{imageList:B.value},null,8,["imageList"])])),_:1})])),_:1}),i(u,{class:"grid-2"},{default:l((()=>[(s(!0),h(S,null,A(k,((e,t)=>(s(),a(u,{class:"item",key:e.name},{default:l((()=>[i(u,{class:"title"},{default:l((()=>[r(c(e.name),1)])),_:2},1024),i(u,{class:R(["data",{blue:2==t,red:0==t}])},{default:l((()=>[r(c(e.data)+" ",1),i(g,{class:"unit"},{default:l((()=>[r(c(e.unit),1)])),_:2},1024)])),_:2},1032,["class"]),i(m,{class:"icon",src:`/static/index/menu${t+1}.png`},null,8,["src"])])),_:2},1024)))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-75806c89"]]);export{B as default};
