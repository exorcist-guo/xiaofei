import{_ as a,u as e,f as s,v as t,g as l,p as r,a as o,w as c,i as u,o as n,b as d,d as f,t as A,h as i,j as _,F as p,m as g,k as m,S as j}from"./index-DWXj2XL_.js";import{i as w}from"./data.CBq6ToZ_.js";import{i as b}from"./user.DhQycmBg.js";import"./request.BZtEVHaK.js";const x=a({__name:"source",setup(a){const{t:x}=e(),C=s({page:1,data:[],source:0,allSource:0});t((()=>{l({title:x("data.source.nTitle")}),z(),S()}));const S=async()=>{const{data:a}=await b();r("userInfo",a),C.allSource=a.all_integral,C.source=a.integral},z=()=>{w({page:C.page}).then((({data:a})=>{console.log(a),C.page+=1,C.data=[...C.data,...a]}))};return(a,e)=>{const s=u,t=g,l=m,r=j;return n(),o(s,{class:"page"},{default:c((()=>[d(s,{class:"banner"},{default:c((()=>[d(s,{class:"flex-start-center-nowrap"},{default:c((()=>[d(s,{class:"left"},{default:c((()=>[d(s,{class:"before"},{default:c((()=>[f(A(a.$t("data.source.lBefore")),1)])),_:1}),d(s,{class:""},{default:c((()=>[f(A(C.source),1)])),_:1})])),_:1}),d(s,{class:"right"},{default:c((()=>[d(s,{class:"before"},{default:c((()=>[f(A(a.$t("data.source.rBefore")),1)])),_:1}),d(s,null,{default:c((()=>[f(A(C.allSource),1)])),_:1})])),_:1})])),_:1}),d(s,{class:"get-btn flex-center-center",onClick:e[0]||(e[0]=e=>a.toUrl("/pages/user/without"))},{default:c((()=>[d(t,null,{default:c((()=>[f(A(a.$t("data.source.goGet")),1)])),_:1}),d(l,{class:"icon",src:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOCAYAAAAfSC3RAAAAAXNSR0IArs4c6QAAAOJJREFUOE9jZCATMCLrCw39z6zC9t2ifSnXUULmoWisjvpmxsDCePL/f4YFbI85UhsOMP7BZQCKRpCi6thveQyMjP0MDIzbWd+zhzVsZvyGTTOGRpCiqphvYQxMjIsYGRjO/2Pg8GlfxPgWXTNWjSBFNbHfnf4zMKxnYGR8xvDnv0frMs6HyJpxagTbHPXLgJHl77b/DAz///z9b961lOsJTDMBjV8MGFmYoRo5zLuWMhLWSJZTkQPnx+/fvr3L+d4QDJyquB+5jAz/JzD8Z9jB+oEjlKjoIDsBkJ3kCKVPZHkA0lpiD+Twia8AAAAASUVORK5CYII="})])),_:1})])),_:1}),d(s,{class:"title flex-row-between-nowrap"},{default:c((()=>[d(s,{class:"tt"},{default:c((()=>[f(A(a.$t("data.source.log")),1)])),_:1}),d(s,{class:"flex-start-center-nowrap more"})])),_:1}),d(r,{class:"scroll","scroll-y":"",onScrolltolower:z},{default:c((()=>[(n(!0),i(p,null,_(C.data,(a=>(n(),o(s,{class:"item flex-row-between-nowrap",key:a.id},{default:c((()=>[d(s,null,{default:c((()=>[d(s,{class:"type"},{default:c((()=>[f(A(a.remark),1)])),_:2},1024),d(s,{class:"name"},{default:c((()=>[f(A(a.action_name),1)])),_:2},1024),d(s,{class:"date"},{default:c((()=>[f(A(a.created_at),1)])),_:2},1024)])),_:2},1024),d(s,{class:"price"},{default:c((()=>[f(A(a.amount),1)])),_:2},1024)])),_:2},1024)))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-d2c98a1a"]]);export{x as default};
