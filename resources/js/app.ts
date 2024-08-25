import './bootstrap';
import '../css/app.css';
import '@/assets/styles.scss';
import '@/assets/tailwind.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';

import AutoComplete from 'primevue/autocomplete';
import CascadeSelect from 'primevue/cascadeselect';
import Checkbox from 'primevue/checkbox';
import ColorPicker from 'primevue/colorpicker';
import DatePicker from 'primevue/datepicker';
import Editor from 'primevue/editor';
import FloatLabel from 'primevue/floatlabel';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import InputMask from 'primevue/inputmask';
import InputNumber from 'primevue/inputnumber';
import InputOtp from 'primevue/inputotp';
import InputText from 'primevue/inputtext';
import Knob from 'primevue/knob';
import Listbox from 'primevue/listbox';
import MultiSelect from 'primevue/multiselect';
import Password from 'primevue/password';
import RadioButton from 'primevue/radiobutton';
import Rating from 'primevue/rating';
import Select from 'primevue/select';
import SelectButton from 'primevue/selectbutton';
import Slider from 'primevue/slider';
import Textarea from 'primevue/textarea';
import ToggleButton from 'primevue/togglebutton';
import ToggleSwitch from 'primevue/toggleswitch';
import TreeSelect from 'primevue/treeselect';
import Button from 'primevue/button';
import SpeedDial from 'primevue/speeddial';
import SplitButton from 'primevue/splitbutton';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Row from 'primevue/row';
import DataView from 'primevue/dataview';
import OrderList from 'primevue/orderlist';
import OrganizationChart from 'primevue/organizationchart';
import Paginator from 'primevue/paginator';
import PickList from 'primevue/picklist';
import Timeline from 'primevue/timeline';
import Tree from 'primevue/tree';
import TreeTable from 'primevue/treetable';
import VirtualScroller from 'primevue/virtualscroller';
import Accordion from 'primevue/accordion';
import AccordionPanel from 'primevue/accordionpanel';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';
import Card from 'primevue/card';
import DeferredContent from 'primevue/deferredcontent';
import Divider from 'primevue/divider';
import Fieldset from 'primevue/fieldset';
import Panel from 'primevue/panel';
import ScrollPanel from 'primevue/scrollpanel';
import Splitter from 'primevue/splitter';
import SplitterPanel from 'primevue/splitterpanel';
import Stepper from 'primevue/stepper';
import StepList from 'primevue/steplist';
import StepPanels from 'primevue/steppanels';
import StepItem from 'primevue/stepitem';
import Step from 'primevue/step';
import StepPanel from 'primevue/steppanel';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';
import Toolbar from 'primevue/toolbar';
import ConfirmDialog from 'primevue/confirmdialog';
import ConfirmationService from 'primevue/confirmationservice';
import ConfirmPopup from 'primevue/confirmpopup';
import Dialog from 'primevue/dialog';
import Drawer from 'primevue/drawer';
import DynamicDialog from 'primevue/dynamicdialog';
import Popover from 'primevue/popover';
import Tooltip from 'primevue/tooltip';
import FileUpload from 'primevue/fileupload';
import Breadcrumb from 'primevue/breadcrumb';
import ContextMenu from 'primevue/contextmenu';
import Dock from 'primevue/dock';
import Menu from 'primevue/menu';
import Menubar from 'primevue/menubar';
import MegaMenu from 'primevue/megamenu';
import PanelMenu from 'primevue/panelmenu';
import TieredMenu from 'primevue/tieredmenu';
import Message from 'primevue/message';
import ToastService from 'primevue/toastservice';
import Toast from 'primevue/toast';
import Carousel from 'primevue/carousel';
import Galleria from 'primevue/galleria';
import Image from 'primevue/image';
import AnimateOnScroll from 'primevue/animateonscroll';
import Avatar from 'primevue/avatar';
import AvatarGroup from 'primevue/avatargroup';
import Badge from 'primevue/badge';
import OverlayBadge from 'primevue/overlaybadge';
import BlockUI from 'primevue/blockui';
import Chip from 'primevue/chip';
import FocusTrap from 'primevue/focustrap';
import Inplace from 'primevue/inplace';
import Fluid from 'primevue/fluid';
import MeterGroup from 'primevue/metergroup';
import ScrollTop from 'primevue/scrolltop';
import Skeleton from 'primevue/skeleton';
import ProgressBar from 'primevue/progressbar';
import ProgressSpinner from 'primevue/progressspinner';
import Ripple from 'primevue/ripple';
import StyleClass from 'primevue/styleclass';
import Tag from 'primevue/tag';
import Terminal from 'primevue/terminal';
import TerminalService from 'primevue/terminalservice'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)

            .use(PrimeVue, {
                theme: {
                    preset: Aura,
                    options: {
                        darkModeSelector: '.app-dark'
                    }
                },
                ripple: true,
            })
            .use(ToastService)
            .use(ConfirmationService)
            .directive('tooltip', Tooltip)
            .directive('animateonscroll', AnimateOnScroll)
            .directive('focustrap', FocusTrap)
            .directive('ripple', Ripple)
            .directive('styleclass', StyleClass)
            .component('AutoComplete', AutoComplete)
            .component('CascadeSelect', CascadeSelect)
            .component('Checkbox', Checkbox)
            .component('ColorPicker', ColorPicker)
            .component('DatePicker', DatePicker)
            .component('Editor', Editor)
            .component('FloatLabel', FloatLabel)
            .component('IconField', IconField)
            .component('InputIcon', InputIcon)
            .component('InputGroup', InputGroup)
            .component('InputGroupAddon', InputGroupAddon)
            .component('InputMask', InputMask)
            .component('InputNumber', InputNumber)
            .component('InputOtp', InputOtp)
            .component('InputText', InputText)
            .component('Knob', Knob)
            .component('Listbox', Listbox)
            .component('MultiSelect', MultiSelect)
            .component('Password', Password)
            .component('RadioButton', RadioButton)
            .component('Rating', Rating)
            .component('Select', Select)
            .component('SelectButton', SelectButton)
            .component('Slider', Slider)
            .component('Textarea', Textarea)
            .component('ToggleButton', ToggleButton)
            .component('ToggleSwitch', ToggleSwitch)
            .component('TreeSelect', TreeSelect)
            .component('Button', Button)
            .component('SpeedDial', SpeedDial)
            .component('SplitButton', SplitButton)
            .component('DataTable', DataTable)
            .component('Column', Column)
            .component('ColumnGroup', ColumnGroup)
            .component('Row', Row)
            .component('DataView', DataView)
            .component('OrderList', OrderList)
            .component('OrganizationChart', OrganizationChart)
            .component('Paginator', Paginator)
            .component('PickList', PickList)
            .component('Timeline', Timeline)
            .component('Tree', Tree)
            .component('TreeTable', TreeTable)
            .component('VirtualScroller', VirtualScroller)
            .component('Accordion', Accordion)
            .component('AccordionPanel', AccordionPanel)
            .component('AccordionHeader', AccordionHeader)
            .component('AccordionContent', AccordionContent)
            .component('Card', Card)
            .component('DeferredContent', DeferredContent)
            .component('Divider', Divider)
            .component('Fieldset', Fieldset)
            .component('Panel', Panel)
            .component('ScrollPanel', ScrollPanel)
            .component('Splitter', Splitter)
            .component('SplitterPanel', SplitterPanel)
            .component('Stepper', Stepper)
            .component('StepList', StepList)
            .component('StepPanels', StepPanels)
            .component('StepItem', StepItem)
            .component('Step', Step)
            .component('StepPanel', StepPanel)
            .component('Tabs', Tabs)
            .component('TabList', TabList)
            .component('Tab', Tab)
            .component('TabPanels', TabPanels)
            .component('TabPanel', TabPanel)
            .component('Toolbar', Toolbar)
            .component('ConfirmDialog', ConfirmDialog)
            .component('ConfirmPopup', ConfirmPopup)
            .component('Dialog', Dialog)
            .component('Drawer', Drawer)
            .component('DynamicDialog', DynamicDialog)
            .component('Popover', Popover)
            .component('FileUpload', FileUpload)
            .component('Breadcrumb', Breadcrumb)
            .component('ContextMenu', ContextMenu)
            .component('Dock', Dock)
            .component('Menu', Menu)
            .component('Menubar', Menubar)
            .component('MegaMenu', MegaMenu)
            .component('PanelMenu', PanelMenu)
            .component('TieredMenu', TieredMenu)
            .component('Message', Message)
            .component('Carousel', Carousel)
            .component('Galleria', Galleria)
            .component('Image', Image)
            .component('Avatar', Avatar)
            .component('AvatarGroup', AvatarGroup)
            .component('Badge', Badge)
            .component('OverlayBadge', OverlayBadge)
            .component('BlockUI', BlockUI)
            .component('Chip', Chip)
            .component('Inplace', Inplace)
            .component('Fluid', Fluid)
            .component('MeterGroup', MeterGroup)
            .component('ScrollTop', ScrollTop)
            .component('Skeleton', Skeleton)
            .component('ProgressBar', ProgressBar)
            .component('ProgressSpinner', ProgressSpinner)
            .component('Tag', Tag)
            .component('Terminal', Terminal)
            .component('TerminalService', TerminalService)
            .component('Toast', Toast)

            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
