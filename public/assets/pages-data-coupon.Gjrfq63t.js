import{_ as a,u as e,f as s,v as t,g as l,p as o,a as c,w as r,i as d,o as u,b as n,d as f,t as A,h as p,j as i,F as m,k as g,m as _,S as h}from"./index-CN2O5Q8r.js";import{d as S}from"./data.BwLjMI4Z.js";import{i as b}from"./user.CiuP7CP4.js";import"./request.7RO1Qo_5.js";const w=a({__name:"coupon",setup(a){const{t:w}=e(),B=s({page:1,data:[],source:0,allSource:0});t((()=>{l({title:w("data.coupon.nTitle")}),j(),R()}));const R=async()=>{const{data:a}=await b();o("userInfo",a),B.allSource=a.dikouquan,B.source=a.dikouquan_k},j=()=>{S({page:B.page}).then((({data:a})=>{console.log(a),B.page+=1,B.data=[...B.data,...a]}))};return(a,e)=>{const s=d,t=g,l=_,o=h;return u(),c(s,{class:"page"},{default:r((()=>[n(s,{class:"banner"},{default:r((()=>[n(s,{class:"flex-start-center-nowrap"},{default:r((()=>[n(s,{class:"left"},{default:r((()=>[n(s,{class:"before"},{default:r((()=>[f(A(a.$t("data.coupon.lBefore")),1)])),_:1}),n(s,{class:""},{default:r((()=>[f(A(B.source),1)])),_:1})])),_:1}),n(s,{class:"right"},{default:r((()=>[n(s,{class:"before"},{default:r((()=>[f(A(a.$t("data.coupon.rBefore")),1)])),_:1}),n(s,null,{default:r((()=>[f(A(B.allSource),1)])),_:1})])),_:1})])),_:1}),n(s,{class:"share-btn flex-center-center",onClick:e[0]||(e[0]=e=>a.toUrl("/pages/user/push"))},{default:r((()=>[n(t,{class:"icon",src:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAAAXNSR0IArs4c6QAAAihJREFUOE/FlM9LVFEcxc954zjvamUFLWphILUJEoKBNmFQNkLUJpoS6k1/QEYZFvmmxbR4o2SgLYpSCHuOlPZjaTAQIS4jihaBRBJtcpFilM6dX/cbYyjSWEwhdJf33O/n3i/ney6xRotrxMH/BCWsK2fcPZYpRghEAGz3hlRDRS+63CrbqoI6Qi4WNgPIiWCc5DEDudblq+5VQe1RUcrONpEmIsISoAHAhAgmhPzS5dt346fnPbGs/dUNdlMiQbMMcmPfGyFVhwBpAbCP5HsAaTFIV1eFJrJFvdciBiB8Ywqm1wpaY7msDveMbPxQMmwRFI9l3gGyVQRjQqZpTDqZqv1c0s6dmtmwPlDbTcgJY3ApT3s0RP0ahje8lN2/5PoiyHWyraS5JcDxpK9eLImdjj5Myh0IX+YDhbM9g+um3VjmNsF6z7ePrByd5dbijj4qMPfntKqvUwgRuo+QZphAm5cKPfl5oW4hTCoXULt7Bjm9Kqi02eFIbRA6bEFGIXy2kM1d7H1UN1vS2qNfN9eo6rcGcqHLr3n86yCXuRZ39E0B8skhu2PlYdfJPABRSPrKWS0NZSA3lhkgOSkiOwh88nyVdJ2FVpLX5y3d2De4aa4ykJMZBrATwCyJXQLcA6QNRZ5MDqvnv8tmeWsx/RSQcK7Ag7RgBSnjgIx4QzXn/xTwMtBVJ3OgkMdU90P1sVTYGf22ZWZqcq7/VTj/V6B//VYqCm0l8B+LztQTgRd8IQAAAABJRU5ErkJggg=="}),n(l,null,{default:r((()=>[f(A(a.$t("user.push.nTitle")),1)])),_:1})])),_:1})])),_:1}),n(s,{class:"title flex-row-between-nowrap"},{default:r((()=>[n(s,{class:"tt"},{default:r((()=>[f(A(a.$t("data.source.log")),1)])),_:1}),n(s,{class:"flex-start-center-nowrap more"})])),_:1}),n(o,{class:"scroll","scroll-y":"",onScrolltolower:j},{default:r((()=>[(u(!0),p(m,null,i(B.data,(a=>(u(),c(s,{class:"item flex-row-between-nowrap",key:a.id},{default:r((()=>[n(s,null,{default:r((()=>[n(s,{class:"type"},{default:r((()=>[f(A(a.remark),1)])),_:2},1024),n(s,{class:"name"},{default:r((()=>[f(A(a.action_name),1)])),_:2},1024),n(s,{class:"date"},{default:r((()=>[f(A(a.created_at),1)])),_:2},1024)])),_:2},1024),n(s,{class:"price"},{default:r((()=>[f(A(a.amount),1)])),_:2},1024)])),_:2},1024)))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-fbce1f05"]]);export{w as default};
