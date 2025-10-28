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

/* @formcreator/field/dropdownfield.html.twig */
class __TwigTemplate_f1464169344588c1c06208b3de5405ab041c2996aab1050e5f65dfbee40f6226 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'questionFields' => [$this, 'block_questionFields'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 30
        return "@formcreator/pages/question.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 31
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/field/dropdownfield.html.twig", 31)->unwrap();
        // line 32
        $macros["formcreatorFields"] = $this->macros["formcreatorFields"] = $this->loadTemplate("@formcreator/components/form/fields_macros.html.twig", "@formcreator/field/dropdownfield.html.twig", 32)->unwrap();
        // line 30
        $this->parent = $this->loadTemplate("@formcreator/pages/question.html.twig", "@formcreator/field/dropdownfield.html.twig", 30);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 34
    public function block_questionFields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        yield "    ";
        yield CoreExtension::callMacro($macros["formcreatorFields"], "macro_dropdownDropdownSubType", ["itemtype", (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source,         // line 37
($context["item"] ?? null), "fields", [], "any", false, false, false, 37)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["itemtype"] ?? null) : null), _n("Dropdown", "Dropdowns", 1), ["on_change" => "plugin_formcreator.changeQuestionType(this)", "label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 35, $context, $this->getSourceContext());
        // line 44
        yield "

    ";
        // line 46
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["required", (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source,         // line 48
($context["item"] ?? null), "fields", [], "any", false, false, false, 48)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["required"] ?? null) : null), __("Required", "formcreator"), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 46, $context, $this->getSourceContext());
        // line 53
        yield "

    ";
        // line 55
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["show_empty", (($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source,         // line 57
($context["item"] ?? null), "fields", [], "any", false, false, false, 57)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["show_empty"] ?? null) : null), __("Show empty", "formcreator"), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 55, $context, $this->getSourceContext());
        // line 62
        yield "

    ";
        // line 64
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, true, false, 64), "itemtype", [], "array", true, true, false, 64) && (0 !== CoreExtension::compare((($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 64)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["itemtype"] ?? null) : null), "0")))) {
            // line 65
            yield "        ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", [(($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source,             // line 66
($context["item"] ?? null), "fields", [], "any", false, false, false, 66)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["itemtype"] ?? null) : null), "default_values", (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source,             // line 68
($context["item"] ?? null), "fields", [], "any", false, false, false, 68)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["default_values"] ?? null) : null), __("Default values"), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 65, $context, $this->getSourceContext());
            // line 73
            yield "
    ";
        } else {
            // line 75
            yield "        ";
            yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 75, $context, $this->getSourceContext());
            // line 78
            yield "
    ";
        }
        // line 80
        yield "
     ";
        // line 81
        yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 81, $context, $this->getSourceContext());
        // line 84
        yield "

    ";
        // line 86
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, true, false, 86), "itemtype", [], "array", true, true, false, 86) && (0 === CoreExtension::compare((($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 86)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["itemtype"] ?? null) : null), "ITILCategory")))) {
            // line 87
            yield "        ";
            yield CoreExtension::callMacro($macros["formcreatorFields"], "macro_dropdownItilCategoryFilter", ["show_ticket_categories", (($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source,             // line 89
($context["item"] ?? null), "fields", [], "any", false, false, false, 89)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["_show_ticket_categories"] ?? null) : null), __("Show ticket categories", "formcreator"), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 87, $context, $this->getSourceContext());
            // line 94
            yield "

     ";
            // line 96
            yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 96, $context, $this->getSourceContext());
            // line 99
            yield "
    ";
        }
        // line 101
        yield "
    ";
        // line 102
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, true, false, 102), "itemtype", [], "array", true, true, false, 102) && ((0 === CoreExtension::compare((($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 102)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["itemtype"] ?? null) : null), "SLA")) || (0 === CoreExtension::compare((($__internal_compile_9 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 102)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["itemtype"] ?? null) : null), "OLA"))))) {
            // line 103
            yield "        ";
            // line 104
            yield "        ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", ["_show_service_level_types", (($__internal_compile_10 = CoreExtension::getAttribute($this->env, $this->source,             // line 106
($context["item"] ?? null), "fields", [], "any", false, false, false, 106)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["_show_service_level_types"] ?? null) : null), [__("Time to resolve", "formcreator"), __("Time to own", "formcreator")], _n("Type", "Types", "formcreator")], 104, $context, $this->getSourceContext());
            // line 112
            yield "

     ";
            // line 114
            yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 114, $context, $this->getSourceContext());
            // line 117
            yield "
    ";
        }
        // line 119
        yield "

    ";
        // line 122
        yield "    ";
        if ((0 === CoreExtension::compare((($__internal_compile_11 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 122)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["_is_tree"] ?? null) : null), "1"))) {
            // line 123
            yield "
        ";
            // line 124
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", [(($__internal_compile_12 = CoreExtension::getAttribute($this->env, $this->source,             // line 125
($context["item"] ?? null), "fields", [], "any", false, false, false, 125)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["itemtype"] ?? null) : null), "show_tree_root", (($__internal_compile_13 = CoreExtension::getAttribute($this->env, $this->source,             // line 127
($context["item"] ?? null), "fields", [], "any", false, false, false, 127)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["_tree_root"] ?? null) : null), __("Subtree root", "formcreator"), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 124, $context, $this->getSourceContext());
            // line 132
            yield "

        ";
            // line 134
            yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["show_tree_depth", (($__internal_compile_14 = CoreExtension::getAttribute($this->env, $this->source,             // line 136
($context["item"] ?? null), "fields", [], "any", false, false, false, 136)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["_tree_max_depth"] ?? null) : null), __("Limit subtree depth", "formcreator"), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 134, $context, $this->getSourceContext());
            // line 141
            yield "

        ";
            // line 143
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["selectable_tree_root", (($__internal_compile_15 = CoreExtension::getAttribute($this->env, $this->source,             // line 145
($context["item"] ?? null), "fields", [], "any", false, false, false, 145)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["_tree_root_selectable"] ?? null) : null), __("Selectable root", "formcreator"), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 143, $context, $this->getSourceContext());
            // line 150
            yield "

        ";
            // line 152
            yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 152, $context, $this->getSourceContext());
            // line 155
            yield "
    ";
        }
        // line 157
        yield "
    ";
        // line 158
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, true, false, 158), "itemtype", [], "array", true, true, false, 158) && (0 === CoreExtension::compare((($__internal_compile_16 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 158)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["_is_entity_restrict"] ?? null) : null), "1")))) {
            // line 159
            yield "        ";
            yield CoreExtension::callMacro($macros["formcreatorFields"], "macro_dropdownEntityRestrict", ["entity_restrict", (($__internal_compile_17 = CoreExtension::getAttribute($this->env, $this->source,             // line 161
($context["item"] ?? null), "fields", [], "any", false, false, false, 161)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["_entity_restrict"] ?? null) : null), __("Entity restriction", "formcreator"), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 159, $context, $this->getSourceContext());
            // line 167
            yield "

        ";
            // line 169
            yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 169, $context, $this->getSourceContext());
            // line 172
            yield "
    ";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/field/dropdownfield.html.twig";
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
        return array (  195 => 172,  193 => 169,  189 => 167,  187 => 161,  185 => 159,  183 => 158,  180 => 157,  176 => 155,  174 => 152,  170 => 150,  168 => 145,  167 => 143,  163 => 141,  161 => 136,  160 => 134,  156 => 132,  154 => 127,  153 => 125,  152 => 124,  149 => 123,  146 => 122,  142 => 119,  138 => 117,  136 => 114,  132 => 112,  130 => 106,  128 => 104,  126 => 103,  124 => 102,  121 => 101,  117 => 99,  115 => 96,  111 => 94,  109 => 89,  107 => 87,  105 => 86,  101 => 84,  99 => 81,  96 => 80,  92 => 78,  89 => 75,  85 => 73,  83 => 68,  82 => 66,  80 => 65,  78 => 64,  74 => 62,  72 => 57,  71 => 55,  67 => 53,  65 => 48,  64 => 46,  60 => 44,  58 => 37,  56 => 35,  52 => 34,  47 => 30,  45 => 32,  43 => 31,  36 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/field/dropdownfield.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\field\\dropdownfield.html.twig");
    }
}
