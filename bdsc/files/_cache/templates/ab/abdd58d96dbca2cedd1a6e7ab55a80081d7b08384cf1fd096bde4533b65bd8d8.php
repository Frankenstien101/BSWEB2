<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @formcreator/pages/form.html.twig */
class __TwigTemplate_f9ab036f4ae17d8b6763ecbe2093fed5caca2fbf8a2e81305449bb157f8cf683 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'form_fields' => [$this, 'block_form_fields'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 31
        return "generic_show_form.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 32
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/pages/form.html.twig", 32)->unwrap();
        // line 33
        $macros["formcreatorFields"] = $this->macros["formcreatorFields"] = $this->loadTemplate("@formcreator/components/form/fields_macros.html.twig", "@formcreator/pages/form.html.twig", 33)->unwrap();
        // line 31
        $this->parent = $this->loadTemplate("generic_show_form.html.twig", "@formcreator/pages/form.html.twig", 31);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 35
    public function block_form_fields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 36
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 36)) {
            // line 37
            yield "        ";
            $context["language"] = "";
            // line 38
            yield "        ";
            $context["iconColor"] = "#999999";
            // line 39
            yield "        ";
            $context["bgColor"] = "#E7E7E7";
            // line 40
            yield "    ";
        } else {
            // line 41
            yield "        ";
            $context["language"] = (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 41)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["language"] ?? null) : null);
            // line 42
            yield "        ";
            $context["iconColor"] = (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 42)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["icon_color"] ?? null) : null);
            // line 43
            yield "        ";
            $context["bgColor"] = (($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 43)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["background_color"] ?? null) : null);
            // line 44
            yield "    ";
        }
        // line 45
        yield "
    ";
        // line 46
        yield CoreExtension::callMacro($macros["fields"], "macro_autoNameField", ["name",         // line 48
($context["item"] ?? null), __("Name"),         // line 50
($context["withtemplate"] ?? null), ["required" => true]], 46, $context, $this->getSourceContext());
        // line 52
        yield "

    ";
        // line 54
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["is_active", (($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 54)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["is_active"] ?? null) : null), __("Active"), ["required" => true]], 54, $context, $this->getSourceContext());
        yield "

    ";
        // line 56
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["PluginFormcreatorCategory", "plugin_formcreator_categories_id", (($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source,         // line 59
($context["item"] ?? null), "fields", [], "any", false, false, false, 59)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["plugin_formcreator_categories_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("PluginFormcreatorCategory")], 56, $context, $this->getSourceContext());
        // line 61
        yield "

    ";
        // line 63
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["helpdesk_home", (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 63)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["helpdesk_home"] ?? null) : null), __("Direct access on homepage", "formcreator")], 63, $context, $this->getSourceContext());
        yield "

    ";
        // line 65
        yield CoreExtension::callMacro($macros["formcreatorFields"], "macro_dropdownFontAwesomeIconField", ["icon", (($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 65)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["icon"] ?? null) : null), __("Icon", "formcreator")], 65, $context, $this->getSourceContext());
        yield "

    ";
        // line 67
        yield CoreExtension::callMacro($macros["fields"], "macro_colorField", ["icon_color", ($context["iconColor"] ?? null), __("Icon color")], 67, $context, $this->getSourceContext());
        yield "

    ";
        // line 69
        yield CoreExtension::callMacro($macros["formcreatorFields"], "macro_dropdownLanguageField", ["language", (($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source,         // line 71
($context["item"] ?? null), "fields", [], "any", false, false, false, 71)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["icon"] ?? null) : null), __("Language", "formcreator"), ["display_emptychoice" => true, "emptylabel" => (("--- " . __("All languages", "formcreator")) . " ---"), "value" =>         // line 76
($context["language"] ?? null)]], 69, $context, $this->getSourceContext());
        // line 78
        yield "

    ";
        // line 80
        yield CoreExtension::callMacro($macros["fields"], "macro_colorField", ["background_color", ($context["bgColor"] ?? null), __("Background color", "formcreator")], 80, $context, $this->getSourceContext());
        yield "

    ";
        // line 82
        yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["description", (($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 82)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["description"] ?? null) : null), __("Description")], 82, $context, $this->getSourceContext());
        yield "

    ";
        // line 84
        yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["content", (($__internal_compile_9 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 84)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["content"] ?? null) : null), _n("Header", "Headers", 1, "formcreator"), ["enable_richtext" => true]], 84, $context, $this->getSourceContext());
        yield "

    ";
        // line 86
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["is_default", (($__internal_compile_10 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 86)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["is_default"] ?? null) : null), __("Default form in service catalog", "formcreator")], 86, $context, $this->getSourceContext());
        yield "

    ";
        // line 88
        $context["tooltip"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showToolTip", [__("If set to 'no', this form won't be shown for self-services users. They will still be able to access this form through its URL.", "formcreator"), ["display" => false]]);
        // line 95
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 95)) {
            // line 96
            yield "        ";
            $context["visible"] = 1;
            // line 97
            yield "    ";
        } else {
            // line 98
            yield "        ";
            $context["visible"] = (($__internal_compile_11 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 98)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["is_visible"] ?? null) : null);
            // line 99
            yield "    ";
        }
        // line 100
        yield "    ";
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["is_visible", ($context["visible"] ?? null), __("Visible", "formcreator"), ["add_field_html" => ($context["tooltip"] ?? null)]], 100, $context, $this->getSourceContext());
        yield "
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/pages/form.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  166 => 100,  163 => 99,  160 => 98,  157 => 97,  154 => 96,  151 => 95,  149 => 88,  144 => 86,  139 => 84,  134 => 82,  129 => 80,  125 => 78,  123 => 76,  122 => 71,  121 => 69,  116 => 67,  111 => 65,  106 => 63,  102 => 61,  100 => 59,  99 => 56,  94 => 54,  90 => 52,  88 => 50,  87 => 48,  86 => 46,  83 => 45,  80 => 44,  77 => 43,  74 => 42,  71 => 41,  68 => 40,  65 => 39,  62 => 38,  59 => 37,  56 => 36,  52 => 35,  47 => 31,  45 => 33,  43 => 32,  36 => 31,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/pages/form.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\pages\\form.html.twig");
    }
}
