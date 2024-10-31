// resources/js/shims-vue.d.ts
declare module '*.vue' {
  import { DefineComponent } from 'vue';
  const component: DefineComponent<object, object, unknown>;
  export default component;
}

declare module '@/Store/LocationStore' {
  import { useLocationStore } from '@/Store/LocationStore';
  export { useLocationStore };
}