import{_ as c}from"./AppLayout-BpxhsGH7.js";import l from"./DeleteUserForm-CLv0WVoE.js";import f from"./LogoutOtherBrowserSessionsForm-Cyw0SxM8.js";import{S as s}from"./SectionBorder-YtDWSeVn.js";import u from"./TwoFactorAuthenticationForm-C48B89zO.js";import d from"./UpdatePasswordForm-IL3Yhbuq.js";import _ from"./UpdateProfileInformationForm-D1XPlHdd.js";import{c as h,w as p,o,a as i,e as r,b as t,f as a,F as g}from"./app-BQlhy0M4.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./DialogModal-DtIY47JL.js";import"./SectionTitle-CtZgXrEz.js";import"./DangerButton-WSriZLM2.js";import"./TextInput-DztICwXs.js";import"./SecondaryButton-C7xrghtu.js";import"./ActionMessage-CllHwR_c.js";import"./PrimaryButton-DvJbdhw3.js";import"./InputLabel-D26kOYzE.js";import"./FormSection-C3uMKPK4.js";const $={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},w={key:0},k={key:1},y={key:2},M={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(e,n)=>(o(),h(c,{title:"Profile"},{header:p(()=>n[0]||(n[0]=[i("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1)])),default:p(()=>[i("div",null,[i("div",$,[e.$page.props.jetstream.canUpdateProfileInformation?(o(),r("div",w,[t(_,{user:e.$page.props.auth.user},null,8,["user"]),t(s)])):a("",!0),e.$page.props.jetstream.canUpdatePassword?(o(),r("div",k,[t(d,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),e.$page.props.jetstream.canManageTwoFactorAuthentication?(o(),r("div",y,[t(u,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(f,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),e.$page.props.jetstream.hasAccountDeletionFeatures?(o(),r(g,{key:3},[t(s),t(l,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{M as default};
