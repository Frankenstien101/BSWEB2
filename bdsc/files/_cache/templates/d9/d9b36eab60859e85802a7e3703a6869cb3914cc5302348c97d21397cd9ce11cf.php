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

/* components/infocom.html.twig */
class __TwigTemplate_8ac22a37c1528f071a5ac657b6e0f6c62d9660d1c8ba9b39731b0823ad7d9fbf extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        yield "
";
        // line 34
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/infocom.html.twig", 34)->unwrap();
        // line 35
        yield "
<div class=\"asset\">
   ";
        // line 37
        if ((($context["can_edit"] ?? null) || ($context["can_create"] ?? null))) {
            // line 38
            yield "      <form action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("front/infocom.form.php"), "html", null, true);
            yield "\" method=\"post\" data-submit-once>
   ";
        }
        // line 40
        yield "
   ";
        // line 41
        if ((0 >= CoreExtension::compare((($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 41)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), 0))) {
            // line 42
            yield "      ";
            if ((($context["can_create"] ?? null) && (0 !== CoreExtension::compare(($context["withtemplate"] ?? null), 2)))) {
                // line 43
                yield "         <div class=\"mx-auto my-4\" style=\"width: 400px;\">
               <input type=\"hidden\" name=\"itemtype\" value=\"";
                // line 44
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 44), "html", null, true);
                yield "\" />
               <input type=\"hidden\" name=\"items_id\" value=\"";
                // line 45
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 45)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["id"] ?? null) : null), "html", null, true);
                yield "\" />
               <button type=\"submit\" class=\"btn btn-primary\" name=\"add\" value=\"1\">
                  <i class=\"fas fa-coins\"></i>
                  <span>";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Enable the financial and administrative information"), "html", null, true);
                yield "</span>
               </button>
         </div>
      ";
            }
            // line 52
            yield "   ";
        } else {
            // line 53
            yield "      ";
            $context["disabled"] = (0 !== CoreExtension::compare(($context["withtemplate"] ?? null), 2));
            // line 54
            yield "      ";
            $context["disabled"] = false;
            // line 55
            yield "      ";
            $context["in_modal"] = (array_key_exists("_get", $context) && ((CoreExtension::getAttribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", true, true, false, 55)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", false, false, false, 55), "0")) : ("0")));
            // line 56
            yield "      <input type=\"hidden\" name=\"id\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 56)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["id"] ?? null) : null), "html", null, true);
            yield "\" />
      <div class=\"card-body d-flex flex-wrap p-0 ";
            // line 57
            yield (((0 === CoreExtension::compare(($context["in_modal"] ?? null), "1"))) ? ("ps-3 me-2") : (""));
            yield "\">
         <div class=\"col-12 flex-column\">
            <div class=\"d-flex flex-row flex-wrap flex-xl-nowrap\">
               <div class=\"row flex-row align-items-start flex-grow-1\">
                  <div class=\"row flex-row\">
                     ";
            // line 63
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_largeTitle", [__("Asset lifecycle"), "fas fa-sync-alt", true], 63, $context, $this->getSourceContext());
            // line 67
            yield "

                     ";
            // line 69
            yield CoreExtension::callMacro($macros["fields"], "macro_dateField", ["order_date", (($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source,             // line 71
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 71)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["order_date"] ?? null) : null), __("Order date"), ["disabled" =>             // line 73
($context["disabled"] ?? null)]], 69, $context, $this->getSourceContext());
            // line 74
            yield "

                     ";
            // line 76
            yield CoreExtension::callMacro($macros["fields"], "macro_dateField", ["buy_date", (($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source,             // line 78
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 78)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["buy_date"] ?? null) : null), __("Date of purchase"), ["disabled" =>             // line 80
($context["disabled"] ?? null)]], 76, $context, $this->getSourceContext());
            // line 81
            yield "

                     ";
            // line 83
            yield CoreExtension::callMacro($macros["fields"], "macro_dateField", ["delivery_date", (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source,             // line 85
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 85)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["delivery_date"] ?? null) : null), __("Delivery date"), ["disabled" =>             // line 87
($context["disabled"] ?? null)]], 83, $context, $this->getSourceContext());
            // line 88
            yield "

                     ";
            // line 90
            yield CoreExtension::callMacro($macros["fields"], "macro_dateField", ["use_date", (($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source,             // line 92
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 92)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["use_date"] ?? null) : null), __("Startup date"), ["disabled" =>             // line 94
($context["disabled"] ?? null)]], 90, $context, $this->getSourceContext());
            // line 95
            yield "

                     ";
            // line 97
            yield CoreExtension::callMacro($macros["fields"], "macro_dateField", ["inventory_date", (($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source,             // line 99
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 99)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["inventory_date"] ?? null) : null), __("Date of last physical inventory"), ["disabled" =>             // line 101
($context["disabled"] ?? null)]], 97, $context, $this->getSourceContext());
            // line 102
            yield "

                     ";
            // line 104
            yield CoreExtension::callMacro($macros["fields"], "macro_dateField", ["decommission_date", (($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source,             // line 106
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 106)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["decommission_date"] ?? null) : null), __("Decommission date"), ["disabled" =>             // line 108
($context["disabled"] ?? null)]], 104, $context, $this->getSourceContext());
            // line 109
            yield "

                     ";
            // line 112
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_largeTitle", [__("Financial and administrative information"), "fas fa-coins"], 112, $context, $this->getSourceContext());
            // line 115
            yield "

                     ";
            // line 117
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Supplier", "suppliers_id", (($__internal_compile_9 = CoreExtension::getAttribute($this->env, $this->source,             // line 120
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 120)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["suppliers_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Supplier"), ["entity" => (($__internal_compile_10 = CoreExtension::getAttribute($this->env, $this->source,             // line 123
($context["item"] ?? null), "fields", [], "any", false, false, false, 123)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["entities_id"] ?? null) : null), "disabled" =>             // line 124
($context["disabled"] ?? null)]], 117, $context, $this->getSourceContext());
            // line 126
            yield "

                     ";
            // line 128
            if ($this->extensions['Glpi\Application\View\Extension\SessionExtension']->hasItemtypeRight("Budget", Twig\Extension\CoreExtension::constant("READ"))) {
                // line 129
                yield "                        ";
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Budget", "budgets_id", (($__internal_compile_11 = CoreExtension::getAttribute($this->env, $this->source,                 // line 132
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 132)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["budgets_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Budget"), ["entity" => (($__internal_compile_12 = CoreExtension::getAttribute($this->env, $this->source,                 // line 135
($context["item"] ?? null), "fields", [], "any", false, false, false, 135)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["entities_id"] ?? null) : null), "comments" => 1, "disabled" =>                 // line 137
($context["disabled"] ?? null)]], 129, $context, $this->getSourceContext());
                // line 139
                yield "
                     ";
            }
            // line 141
            yield "
                     ";
            // line 142
            yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["order_number", (($__internal_compile_13 = CoreExtension::getAttribute($this->env, $this->source,             // line 144
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 144)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["order_number"] ?? null) : null), __("Order number"), ["disabled" =>             // line 146
($context["disabled"] ?? null)]], 142, $context, $this->getSourceContext());
            // line 147
            yield "

                     ";
            // line 149
            yield CoreExtension::callMacro($macros["fields"], "macro_autoNameField", ["immo_number",             // line 151
($context["infocom"] ?? null), __("Immobilization number"),             // line 153
($context["withtemplate"] ?? null), ["disabled" =>             // line 154
($context["disabled"] ?? null), "value" => (($__internal_compile_14 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 154)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["immo_number"] ?? null) : null)]], 149, $context, $this->getSourceContext());
            // line 155
            yield "

                     ";
            // line 157
            yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["bill", (($__internal_compile_15 = CoreExtension::getAttribute($this->env, $this->source,             // line 159
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 159)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["bill"] ?? null) : null), __("Invoice number"), ["disabled" =>             // line 161
($context["disabled"] ?? null)]], 157, $context, $this->getSourceContext());
            // line 162
            yield "

                     ";
            // line 164
            yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["delivery_number", (($__internal_compile_16 = CoreExtension::getAttribute($this->env, $this->source,             // line 166
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 166)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["delivery_number"] ?? null) : null), __("Delivery form"), ["disabled" =>             // line 168
($context["disabled"] ?? null)]], 164, $context, $this->getSourceContext());
            // line 169
            yield "

                     ";
            // line 171
            yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["value", (($__internal_compile_17 = CoreExtension::getAttribute($this->env, $this->source,             // line 173
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 173)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["value"] ?? null) : null), _x("price", "Value"), ["disabled" =>             // line 176
($context["disabled"] ?? null), "step" => "any"]], 171, $context, $this->getSourceContext());
            // line 179
            yield "

                     ";
            // line 181
            yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["warranty_value", (($__internal_compile_18 = CoreExtension::getAttribute($this->env, $this->source,             // line 183
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 183)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["warranty_value"] ?? null) : null), __("Warranty extension value"), ["disabled" =>             // line 186
($context["disabled"] ?? null), "step" => "any"]], 181, $context, $this->getSourceContext());
            // line 189
            yield "


                     ";
            // line 192
            $context["amort"] = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "Amort", [(($__internal_compile_19 = CoreExtension::getAttribute($this->env, $this->source,             // line 193
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 193)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["sink_type"] ?? null) : null), (($__internal_compile_20 = CoreExtension::getAttribute($this->env, $this->source,             // line 194
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 194)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["value"] ?? null) : null), (($__internal_compile_21 = CoreExtension::getAttribute($this->env, $this->source,             // line 195
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 195)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["sink_time"] ?? null) : null), (($__internal_compile_22 = CoreExtension::getAttribute($this->env, $this->source,             // line 196
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 196)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["sink_coeff"] ?? null) : null), (($__internal_compile_23 = CoreExtension::getAttribute($this->env, $this->source,             // line 197
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 197)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["buy_date"] ?? null) : null), (($__internal_compile_24 = CoreExtension::getAttribute($this->env, $this->source,             // line 198
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 198)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["use_date"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("date_tax"), "n"], "method", false, false, false, 192);
            // line 202
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_readOnlyField", ["", $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedNumber(            // line 204
($context["amort"] ?? null)), __("Account net value")], 202, $context, $this->getSourceContext());
            // line 206
            yield "

                     ";
            // line 208
            if (((0 === CoreExtension::compare(($context["withtemplate"] ?? null), 2)) || (0 === CoreExtension::compare(($context["disabled"] ?? null), true)))) {
                // line 209
                yield "                        ";
                $context["sink_type_field"] = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "getAmortTypeName", [(($__internal_compile_25 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 209)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["sink_type"] ?? null) : null)], "method", false, false, false, 209);
                // line 210
                yield "                     ";
            } else {
                // line 211
                yield "                        ";
                $context["sink_type_field"] = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "dropdownAmortType", ["sink_type", (($__internal_compile_26 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 211)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["sink_type"] ?? null) : null), false], "method", false, false, false, 211);
                // line 212
                yield "                     ";
            }
            // line 213
            yield "
                     ";
            // line 214
            yield CoreExtension::callMacro($macros["fields"], "macro_field", ["",             // line 216
($context["sink_type_field"] ?? null), __("Amortization type")], 214, $context, $this->getSourceContext());
            // line 218
            yield "

                     ";
            // line 220
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownNumberField", ["sink_time", (($__internal_compile_27 = CoreExtension::getAttribute($this->env, $this->source,             // line 222
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 222)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["sink_time"] ?? null) : null), __("Amortization duration"), ["max" => 15, "unit" => "year", "disabled" =>             // line 227
($context["disabled"] ?? null)]], 220, $context, $this->getSourceContext());
            // line 229
            yield "

                     ";
            // line 231
            yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["sink_coeff", (($__internal_compile_28 = CoreExtension::getAttribute($this->env, $this->source,             // line 233
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 233)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["sink_coeff"] ?? null) : null), __("Amortization coefficient"), ["disabled" =>             // line 235
($context["disabled"] ?? null), "step" => "any"]], 231, $context, $this->getSourceContext());
            // line 236
            yield "

                     ";
            // line 238
            if (!CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 238), Twig\Extension\CoreExtension::merge(CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "getExcludedTypes", [], "method", false, false, false, 238), ["Cartridge", "Consumable", "SoftwareLicense"]))) {
                // line 239
                yield "                        ";
                $context["ticket_tco_value"] = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "showTco", [(($__internal_compile_29 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 239)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["ticket_tco"] ?? null) : null), (($__internal_compile_30 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 239)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["value"] ?? null) : null)], "method", false, false, false, 239);
                // line 240
                yield "                        ";
                yield CoreExtension::callMacro($macros["fields"], "macro_readOnlyField", ["ticket_tco",                 // line 242
($context["ticket_tco_value"] ?? null), __("TCO (value + tracking cost)"), ["disabled" =>                 // line 244
($context["disabled"] ?? null)]], 240, $context, $this->getSourceContext());
                // line 245
                yield "

                        ";
                // line 247
                $context["ticket_tco2_value"] = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "showTco", [(($__internal_compile_31 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 247)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["ticket_tco"] ?? null) : null), (($__internal_compile_32 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 247)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["value"] ?? null) : null), (($__internal_compile_33 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 247)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["buy_date"] ?? null) : null)], "method", false, false, false, 247);
                // line 248
                yield "                        ";
                yield CoreExtension::callMacro($macros["fields"], "macro_readOnlyField", ["ticket_tco",                 // line 250
($context["ticket_tco2_value"] ?? null), __("Monthly TCO"), ["disabled" =>                 // line 252
($context["disabled"] ?? null)]], 248, $context, $this->getSourceContext());
                // line 253
                yield "
                     ";
            }
            // line 255
            yield "

                     ";
            // line 257
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["BusinessCriticity", "businesscriticities_id", (($__internal_compile_34 = CoreExtension::getAttribute($this->env, $this->source,             // line 260
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 260)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["businesscriticities_id"] ?? null) : null), _n("Business criticity", "Business criticities", 1), ["disabled" =>             // line 263
($context["disabled"] ?? null)]], 257, $context, $this->getSourceContext());
            // line 265
            yield "

                     ";
            // line 267
            yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["comment", (($__internal_compile_35 = CoreExtension::getAttribute($this->env, $this->source,             // line 269
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 269)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["comment"] ?? null) : null), _n("Comment", "Comments", Session::getPluralNumber()), ["disabled" =>             // line 271
($context["disabled"] ?? null)]], 267, $context, $this->getSourceContext());
            // line 272
            yield "

                     ";
            // line 275
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_largeTitle", [__("Warranty information"), "fas fa-file-contract"], 275, $context, $this->getSourceContext());
            // line 278
            yield "

                     ";
            // line 280
            yield CoreExtension::callMacro($macros["fields"], "macro_dateField", ["warranty_date", (($__internal_compile_36 = CoreExtension::getAttribute($this->env, $this->source,             // line 282
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 282)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["warranty_date"] ?? null) : null), __("Start date of warranty"), ["disabled" =>             // line 284
($context["disabled"] ?? null)]], 280, $context, $this->getSourceContext());
            // line 285
            yield "

                     ";
            // line 287
            if ((0 === CoreExtension::compare(($context["withtemplate"] ?? null), 2))) {
                // line 288
                yield "                        ";
                if ((0 === CoreExtension::compare((($__internal_compile_37 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 288)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["warranty_duration"] ?? null) : null),  -1))) {
                    // line 289
                    yield "                           ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Lifelong"), "html", null, true);
                    yield "
                        ";
                } else {
                    // line 291
                    yield "                           ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::sprintf(_n("%d month", "%d months", (($__internal_compile_38 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 291)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["warranty_duration"] ?? null) : null)), (($__internal_compile_39 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 291)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["warranty_duration"] ?? null) : null)), "html", null, true);
                    yield "
                        ";
                }
                // line 293
                yield "                     ";
            } else {
                // line 294
                yield "                        ";
                $context["warrantyexpir"] = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "getWarrantyExpir", [(($__internal_compile_40 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 294)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["warranty_date"] ?? null) : null), (($__internal_compile_41 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 294)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41["warranty_duration"] ?? null) : null), 0, true], "method", false, false, false, 294);
                // line 295
                yield "                        ";
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownNumberField", ["warranty_duration", (($__internal_compile_42 = CoreExtension::getAttribute($this->env, $this->source,                 // line 297
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 297)) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42["warranty_duration"] ?? null) : null), __("Warranty duration"), ["min" => 0, "max" => 120, "step" => 1, "toadd" => ["-1" => __("Lifelong")], "unit" => "month", "disabled" =>                 // line 305
($context["disabled"] ?? null), "add_field_html" => (("<span class=\"text-muted\">" . Twig\Extension\CoreExtension::sprintf(__("Valid to %s"),                 // line 306
($context["warrantyexpir"] ?? null))) . "</span>")]], 295, $context, $this->getSourceContext());
                // line 308
                yield "
                     ";
            }
            // line 310
            yield "
                     ";
            // line 311
            yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["warranty_info", (($__internal_compile_43 = CoreExtension::getAttribute($this->env, $this->source,             // line 313
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 313)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43["warranty_info"] ?? null) : null), __("Warranty information"), ["disabled" =>             // line 315
($context["disabled"] ?? null)]], 311, $context, $this->getSourceContext());
            // line 316
            yield "

                     ";
            // line 318
            if ($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("use_notifications")) {
                // line 319
                yield "                        ";
                $context["alert_html"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 320
                    yield "                           ";
                    $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Alert::displayLastAlert", ["Infocom", (($__internal_compile_44 = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "fields", [], "any", false, false, false, 320)) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44["id"] ?? null) : null)]);
                    // line 321
                    yield "                        ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 322
                yield "
                        ";
                // line 323
                $context["alert_field"] = CoreExtension::getAttribute($this->env, $this->source, ($context["infocom"] ?? null), "dropdownAlert", [["name" => "alert", "value" => (($__internal_compile_45 = CoreExtension::getAttribute($this->env, $this->source,                 // line 325
($context["infocom"] ?? null), "fields", [], "any", false, false, false, 325)) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45["alert"] ?? null) : null), "display" => false, "width" => "100%", "class" => "form-select"]], "method", false, false, false, 323);
                // line 330
                yield "
                        ";
                // line 331
                yield CoreExtension::callMacro($macros["fields"], "macro_field", ["alert",                 // line 333
($context["alert_field"] ?? null), __("Alarms on financial and administrative information"), ["add_field_html" => (("<span class=\"text-muted\">" .                 // line 335
($context["alert_html"] ?? null)) . "</span>")]], 331, $context, $this->getSourceContext());
                // line 336
                yield "
                     ";
            }
            // line 338
            yield "
                     ";
            // line 339
            $this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHookFunction(Twig\Extension\CoreExtension::constant("Glpi\\Plugin\\Hooks::INFOCOM"), ($context["item"] ?? null));
            // line 340
            yield "
                     <div class=\"card-body mx-n2 mb-4  border-top\">
                        ";
            // line 342
            if (($context["can_global_update"] ?? null)) {
                // line 343
                yield "                           <button class=\"btn btn-primary me-2\" type=\"submit\" name=\"update\">
                              <i class=\"far fa-save\"></i>
                              <span>";
                // line 345
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Save"), "html", null, true);
                yield "</span>
                           </button>
                        ";
            }
            // line 348
            yield "
                        ";
            // line 349
            if (($context["can_global_purge"] ?? null)) {
                // line 350
                yield "                           <button class=\"btn btn-outline-danger me-2\" type=\"submit\" name=\"purge\">
                              <i class=\"fas fa-trash-alt\"></i>
                              <span>";
                // line 352
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Delete permanently"), "html", null, true);
                yield "</span>
                           </button>
                        ";
            }
            // line 355
            yield "                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   ";
        }
        // line 363
        yield "
   ";
        // line 364
        if ((($context["can_edit"] ?? null) || ($context["can_create"] ?? null))) {
            // line 365
            yield "      <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
            yield "\" />
   </form>
   ";
        }
        // line 368
        yield "</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/infocom.html.twig";
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
        return array (  491 => 368,  484 => 365,  482 => 364,  479 => 363,  469 => 355,  463 => 352,  459 => 350,  457 => 349,  454 => 348,  448 => 345,  444 => 343,  442 => 342,  438 => 340,  436 => 339,  433 => 338,  429 => 336,  427 => 335,  426 => 333,  425 => 331,  422 => 330,  420 => 325,  419 => 323,  416 => 322,  412 => 321,  409 => 320,  406 => 319,  404 => 318,  400 => 316,  398 => 315,  397 => 313,  396 => 311,  393 => 310,  389 => 308,  387 => 306,  386 => 305,  385 => 297,  383 => 295,  380 => 294,  377 => 293,  371 => 291,  365 => 289,  362 => 288,  360 => 287,  356 => 285,  354 => 284,  353 => 282,  352 => 280,  348 => 278,  345 => 275,  341 => 272,  339 => 271,  338 => 269,  337 => 267,  333 => 265,  331 => 263,  330 => 260,  329 => 257,  325 => 255,  321 => 253,  319 => 252,  318 => 250,  316 => 248,  314 => 247,  310 => 245,  308 => 244,  307 => 242,  305 => 240,  302 => 239,  300 => 238,  296 => 236,  294 => 235,  293 => 233,  292 => 231,  288 => 229,  286 => 227,  285 => 222,  284 => 220,  280 => 218,  278 => 216,  277 => 214,  274 => 213,  271 => 212,  268 => 211,  265 => 210,  262 => 209,  260 => 208,  256 => 206,  254 => 204,  252 => 202,  250 => 198,  249 => 197,  248 => 196,  247 => 195,  246 => 194,  245 => 193,  244 => 192,  239 => 189,  237 => 186,  236 => 183,  235 => 181,  231 => 179,  229 => 176,  228 => 173,  227 => 171,  223 => 169,  221 => 168,  220 => 166,  219 => 164,  215 => 162,  213 => 161,  212 => 159,  211 => 157,  207 => 155,  205 => 154,  204 => 153,  203 => 151,  202 => 149,  198 => 147,  196 => 146,  195 => 144,  194 => 142,  191 => 141,  187 => 139,  185 => 137,  184 => 135,  183 => 132,  181 => 129,  179 => 128,  175 => 126,  173 => 124,  172 => 123,  171 => 120,  170 => 117,  166 => 115,  163 => 112,  159 => 109,  157 => 108,  156 => 106,  155 => 104,  151 => 102,  149 => 101,  148 => 99,  147 => 97,  143 => 95,  141 => 94,  140 => 92,  139 => 90,  135 => 88,  133 => 87,  132 => 85,  131 => 83,  127 => 81,  125 => 80,  124 => 78,  123 => 76,  119 => 74,  117 => 73,  116 => 71,  115 => 69,  111 => 67,  108 => 63,  100 => 57,  95 => 56,  92 => 55,  89 => 54,  86 => 53,  83 => 52,  76 => 48,  70 => 45,  66 => 44,  63 => 43,  60 => 42,  58 => 41,  55 => 40,  49 => 38,  47 => 37,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/infocom.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\infocom.html.twig");
    }
}
