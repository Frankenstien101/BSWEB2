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

/* components/itilobject/fields_panel.html.twig */
class __TwigTemplate_f0f8636879621971c3b967ada13fa80901b962783ef133b2b55daff88900cefb extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/fields_panel.html.twig", 34)->unwrap();
        // line 35
        $context["field_options"] = ["full_width" => true, "fields_template" =>         // line 37
($context["itiltemplate"] ?? null), "disabled" =>  !        // line 38
($context["canupdate"] ?? null), "add_field_class" => ((        // line 39
($context["is_expanded"] ?? null)) ? ("col-sm-6") : (""))];
        // line 41
        yield "
";
        // line 42
        $context["itil_layout"] = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->userPref("itil_layout", true);
        // line 43
        $context["headers_states"] = (($__internal_compile_0 = ($context["itil_layout"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["items"] ?? null) : null);
        // line 44
        yield "
<div class=\"accordion open accordion-flush\" id=\"itil-data\">
   ";
        // line 46
        $context["main_show"] = ((( !CoreExtension::getAttribute($this->env, $this->source, ($context["headers_states"] ?? null), "item-main", [], "array", true, true, false, 46) || (0 === CoreExtension::compare((($__internal_compile_1 = ($context["headers_states"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["item-main"] ?? null) : null), "true")))) ? (true) : (false));
        // line 47
        yield "   <div class=\"accordion-item\">
      <h2 class=\"accordion-header\" id=\"heading-main-item\">
         <button class=\"accordion-button ";
        // line 49
        yield ((($context["main_show"] ?? null)) ? ("") : ("collapsed"));
        yield "\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#item-main\" aria-expanded=\"true\" aria-controls=\"ticket-main\">
            <i class=\"ti ti-alert-circle me-1 item-icon\"></i>
            <span class='status-recall'>
                ";
        // line 52
        yield CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getStatusIcon", [(($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 52)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["status"] ?? null) : null)], "method", false, false, false, 52);
        yield "
            </span>
            <span class=\"item-title\">
                ";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getTypeName", [1], "method", false, false, false, 55), "html", null, true);
        yield "
            </span>
         </button>
      </h2>
      <div id=\"item-main\" class=\"accordion-collapse collapse ";
        // line 59
        yield ((($context["main_show"] ?? null)) ? ("show") : (""));
        yield "\" aria-labelledby=\"heading-main-item\">
         <div class=\"accordion-body row m-0 mt-n2\">

            ";
        // line 62
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("pre_item_form", ["item" => ($context["item"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
        yield "

            ";
        // line 64
        if (Session::isMultiEntitiesMode()) {
            // line 65
            yield "               ";
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 65)) {
                // line 66
                yield "                  ";
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Entity", "entities_id", (($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source,                 // line 69
($context["item"] ?? null), "fields", [], "any", false, false, false, 69)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["entities_id"] ?? null) : null), _n("Entity", "Entities", 1), Twig\Extension\CoreExtension::merge(                // line 71
($context["field_options"] ?? null), ["entity" =>                 // line 72
($context["userentities"] ?? null), "on_change" => "this.form.submit()"])], 66, $context, $this->getSourceContext());
                // line 75
                yield "
               ";
            } else {
                // line 77
                yield "                  ";
                $context["entity_html"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 78
                    yield "                     ";
                    yield $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Entity::badgeCompletenameLinkById", [(($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 78)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["entities_id"] ?? null) : null)]);
                    yield "
                  ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 80
                yield "
                  ";
                // line 81
                yield CoreExtension::callMacro($macros["fields"], "macro_field", ["",                 // line 83
($context["entity_html"] ?? null), _n("Entity", "Entities", 1), Twig\Extension\CoreExtension::merge(                // line 85
($context["field_options"] ?? null), ["add_field_class" => "d-flex align-items-center"])], 81, $context, $this->getSourceContext());
                // line 88
                yield "
               ";
            }
            // line 90
            yield "
               ";
            // line 91
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["is_recursive"], "method", false, false, false, 91)) {
                // line 92
                yield "                  ";
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["is_recursive", (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source,                 // line 94
($context["item"] ?? null), "fields", [], "any", false, false, false, 94)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["is_recursive"] ?? null) : null), __("Child entities"),                 // line 96
($context["field_options"] ?? null)], 92, $context, $this->getSourceContext());
                // line 97
                yield "
               ";
            }
            // line 99
            yield "            ";
        }
        // line 100
        yield "
            ";
        // line 101
        yield CoreExtension::callMacro($macros["fields"], "macro_datetimeField", ["date", (($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source,         // line 103
($context["item"] ?? null), "fields", [], "any", false, false, false, 103)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["date"] ?? null) : null), __("Opening date"),         // line 105
($context["field_options"] ?? null)], 101, $context, $this->getSourceContext());
        // line 106
        yield "

            ";
        // line 108
        if ((0 !== CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 108), "Ticket"))) {
            // line 109
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_datetimeField", ["time_to_resolve", (($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source,             // line 111
($context["item"] ?? null), "fields", [], "any", false, false, false, 111)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["time_to_resolve"] ?? null) : null), __("Time to resolve"),             // line 113
($context["field_options"] ?? null)], 109, $context, $this->getSourceContext());
            // line 114
            yield "
            ";
        }
        // line 116
        yield "
            ";
        // line 117
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isSolved", [true], "method", false, false, false, 117)) {
            // line 118
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_datetimeField", ["solvedate", (($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source,             // line 120
($context["item"] ?? null), "fields", [], "any", false, false, false, 120)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["solvedate"] ?? null) : null), __("Resolution date"),             // line 122
($context["field_options"] ?? null)], 118, $context, $this->getSourceContext());
            // line 123
            yield "
            ";
        }
        // line 125
        yield "
            ";
        // line 126
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isClosed", [], "method", false, false, false, 126)) {
            // line 127
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_datetimeField", ["closedate", (($__internal_compile_9 = CoreExtension::getAttribute($this->env, $this->source,             // line 129
($context["item"] ?? null), "fields", [], "any", false, false, false, 129)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["closedate"] ?? null) : null), __("Close date"),             // line 131
($context["field_options"] ?? null)], 127, $context, $this->getSourceContext());
            // line 132
            yield "
            ";
        }
        // line 134
        yield "
            ";
        // line 135
        if ((0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 135), "Ticket"))) {
            // line 136
            yield "               ";
            $context["type_params"] = Twig\Extension\CoreExtension::merge(["value" => (($__internal_compile_10 = CoreExtension::getAttribute($this->env, $this->source,             // line 137
($context["item"] ?? null), "fields", [], "any", false, false, false, 137)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["type"] ?? null) : null), "width" => "100%", "display" => false],             // line 140
($context["field_options"] ?? null));
            // line 141
            yield "               ";
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 141)) {
                // line 142
                yield "                  ";
                $context["type_params"] = Twig\Extension\CoreExtension::merge(($context["type_params"] ?? null), ["on_change" => "this.form.submit()"]);
                // line 143
                yield "               ";
            } else {
                // line 144
                yield "                  ";
                $context["type_params"] = Twig\Extension\CoreExtension::merge(($context["type_params"] ?? null), ["on_change" => "reloadCategory()"]);
                // line 145
                yield "               ";
            }
            // line 146
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_field", ["type", CoreExtension::getAttribute($this->env, $this->source,             // line 148
($context["item"] ?? null), "dropdownType", ["type", ($context["type_params"] ?? null)], "method", false, false, false, 148), _n("Type", "Types", 1),             // line 150
($context["field_options"] ?? null)], 146, $context, $this->getSourceContext());
            // line 151
            yield "
            ";
        }
        // line 153
        yield "
            ";
        // line 154
        $context["cat_params"] = Twig\Extension\CoreExtension::merge(($context["field_options"] ?? null), ["entity" => (($__internal_compile_11 = CoreExtension::getAttribute($this->env, $this->source,         // line 155
($context["item"] ?? null), "fields", [], "any", false, false, false, 155)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["entities_id"] ?? null) : null), "disabled" =>  !(        // line 156
($context["canupdate"] ?? null) || ($context["can_requester"] ?? null))]);
        // line 158
        yield "            ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 158)) {
            // line 159
            yield "               ";
            $context["cat_params"] = Twig\Extension\CoreExtension::merge(($context["cat_params"] ?? null), ["on_change" => "this.form.submit()"]);
            // line 162
            yield "            ";
        }
        // line 163
        yield "            ";
        if ((( !CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 163) && CoreExtension::getAttribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isMandatoryField", ["itilcategories_id"], "method", false, false, false, 163)) && (1 === CoreExtension::compare((($__internal_compile_12 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 163)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["itilcategories_id"] ?? null) : null), 0)))) {
            // line 164
            yield "               ";
            $context["cat_params"] = Twig\Extension\CoreExtension::merge(($context["cat_params"] ?? null), ["display_emptychoice" => false]);
            // line 167
            yield "            ";
        }
        // line 168
        yield "            ";
        if ((0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 168), "Ticket"))) {
            // line 169
            yield "               ";
            if ((0 === CoreExtension::compare((($__internal_compile_13 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 169)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["type"] ?? null) : null), Twig\Extension\CoreExtension::constant("Ticket::INCIDENT_TYPE")))) {
                // line 170
                yield "                  ";
                $context["cat_params"] = Twig\Extension\CoreExtension::merge(($context["cat_params"] ?? null), ["condition" => ["is_incident" => 1]]);
                // line 171
                yield "               ";
            } elseif ((0 === CoreExtension::compare((($__internal_compile_14 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 171)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["type"] ?? null) : null), Twig\Extension\CoreExtension::constant("Ticket::DEMAND_TYPE")))) {
                // line 172
                yield "                  ";
                $context["cat_params"] = Twig\Extension\CoreExtension::merge(($context["cat_params"] ?? null), ["condition" => ["is_request" => 1]]);
                // line 173
                yield "               ";
            }
            // line 174
            yield "            ";
        } elseif ((0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 174), "Problem"))) {
            // line 175
            yield "               ";
            $context["cat_params"] = Twig\Extension\CoreExtension::merge(($context["cat_params"] ?? null), ["condition" => ["is_problem" => 1]]);
            // line 176
            yield "            ";
        } elseif ((0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 176), "Change"))) {
            // line 177
            yield "               ";
            $context["cat_params"] = Twig\Extension\CoreExtension::merge(($context["cat_params"] ?? null), ["condition" => ["is_change" => 1]]);
            // line 178
            yield "            ";
        }
        // line 179
        yield "            <span id=\"category_block_";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield "\">
            ";
        // line 180
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["ITILCategory", "itilcategories_id", (($__internal_compile_15 = CoreExtension::getAttribute($this->env, $this->source,         // line 183
($context["item"] ?? null), "fields", [], "any", false, false, false, 183)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["itilcategories_id"] ?? null) : null), _n("Category", "Categories", 1),         // line 185
($context["cat_params"] ?? null)], 180, $context, $this->getSourceContext());
        // line 186
        yield "
            </span>

            ";
        // line 189
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/fields/status.html.twig");
        yield "

            ";
        // line 191
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["requesttypes_id"], "method", false, false, false, 191)) {
            // line 192
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["RequestType", "requesttypes_id", (($__internal_compile_16 = CoreExtension::getAttribute($this->env, $this->source,             // line 195
($context["item"] ?? null), "fields", [], "any", false, false, false, 195)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["requesttypes_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("RequestType"), Twig\Extension\CoreExtension::merge(            // line 197
($context["field_options"] ?? null), ["condition" => ["is_active" => 1, "is_ticketheader" => 1]])], 192, $context, $this->getSourceContext());
            // line 203
            yield "
            ";
        }
        // line 205
        yield "
            ";
        // line 206
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/fields/priority_matrix.html.twig");
        yield "

            ";
        // line 208
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["locations_id"], "method", false, false, false, 208)) {
            // line 209
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Location", "locations_id", (($__internal_compile_17 = CoreExtension::getAttribute($this->env, $this->source,             // line 212
($context["item"] ?? null), "fields", [], "any", false, false, false, 212)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["locations_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Location"), Twig\Extension\CoreExtension::merge(            // line 214
($context["field_options"] ?? null), ["hide_if_no_elements" => true, "entity" => (($__internal_compile_18 = CoreExtension::getAttribute($this->env, $this->source,             // line 216
($context["item"] ?? null), "fields", [], "any", false, false, false, 216)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["entities_id"] ?? null) : null), "entity_sons" => true])], 209, $context, $this->getSourceContext());
            // line 219
            yield "
            ";
        }
        // line 221
        yield "
            ";
        // line 222
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 222) && (0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 222), "Ticket")))) {
            // line 223
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Contract", "_contracts_id", ((CoreExtension::getAttribute($this->env, $this->source,             // line 226
($context["params"] ?? null), "_contracts_id", [], "array", true, true, false, 226)) ? (Twig\Extension\CoreExtension::default((($__internal_compile_19 = ($context["params"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["_contracts_id"] ?? null) : null), 0)) : (0)), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Contract"), Twig\Extension\CoreExtension::merge(            // line 228
($context["field_options"] ?? null), ["entity" => (($__internal_compile_20 = CoreExtension::getAttribute($this->env, $this->source,             // line 229
($context["item"] ?? null), "fields", [], "any", false, false, false, 229)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["entities_id"] ?? null) : null), "width" => "100%", "hide_if_no_elements" => true, "nochecklimit" => true])], 223, $context, $this->getSourceContext());
            // line 234
            yield "
            ";
        }
        // line 236
        yield "
            ";
        // line 237
        if (((0 !== CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 237), "Ticket")) || CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 237))) {
            // line 238
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownTimestampField", ["actiontime", (($__internal_compile_21 = CoreExtension::getAttribute($this->env, $this->source,             // line 240
($context["item"] ?? null), "fields", [], "any", false, false, false, 240)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["actiontime"] ?? null) : null), __("Total duration"),             // line 242
($context["field_options"] ?? null)], 238, $context, $this->getSourceContext());
            // line 243
            yield "
            ";
        }
        // line 245
        yield "
            ";
        // line 246
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/fields/global_validation.html.twig");
        yield "

            ";
        // line 248
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("post_item_form", ["item" => ($context["item"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
        yield "
         </div>
      </div>
   </div>

   ";
        // line 253
        $context["actors_show"] = ((( !CoreExtension::getAttribute($this->env, $this->source, ($context["headers_states"] ?? null), "actors", [], "array", true, true, false, 253) || (0 === CoreExtension::compare((($__internal_compile_22 = ($context["headers_states"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["actors"] ?? null) : null), "true")))) ? (true) : (false));
        // line 254
        yield "   <div class=\"accordion-item\">
      <h2 class=\"accordion-header\" id=\"heading-actor\" title=\"";
        // line 255
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Actors"), "html", null, true);
        yield "\" data-bs-toggle=\"tooltip\">
         <button class=\"accordion-button ";
        // line 256
        yield ((($context["actors_show"] ?? null)) ? ("") : ("collapsed"));
        yield "\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#actors\" aria-expanded=\"true\" aria-controls=\"actors\">
            <i class=\"ti ti-users me-1\"></i>
            <span class=\"item-title\">
                ";
        // line 259
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Actors"), "html", null, true);
        yield "
            </span>
            <span class=\"badge bg-secondary ms-2\">
               ";
        // line 262
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "countActors", [], "method", false, false, false, 262), "html", null, true);
        yield "
            </span>
         </button>
      </h2>
      <div id=\"actors\" class=\"accordion-collapse collapse ";
        // line 266
        yield ((($context["actors_show"] ?? null)) ? ("show") : (""));
        yield "\" aria-labelledby=\"heading-actor\">
         <div class=\"accordion-body accordion-actors row m-0 mt-n2\">
            ";
        // line 268
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/actors/main.html.twig");
        yield "
         </div>
      </div>
   </div>

   ";
        // line 273
        if ((array_key_exists("item_ticket", $context) &&  !(null === ($context["item_ticket"] ?? null)))) {
            // line 274
            yield "      ";
            $context["items_show"] = ((( !CoreExtension::getAttribute($this->env, $this->source, ($context["headers_states"] ?? null), "items", [], "array", true, true, false, 274) || (0 === CoreExtension::compare((($__internal_compile_23 = ($context["headers_states"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["items"] ?? null) : null), "true")))) ? (true) : (false));
            // line 275
            yield "      <div class=\"accordion-item\">
         <h2 class=\"accordion-header\" id=\"items-heading\" title=\"";
            // line 276
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Item", "Items", Session::getPluralNumber()), "html", null, true);
            yield "\" data-bs-toggle=\"tooltip\">
            <button class=\"accordion-button ";
            // line 277
            yield ((($context["items_show"] ?? null)) ? ("") : ("collapsed"));
            yield "\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#items\" aria-expanded=\"true\" aria-controls=\"items\">
               <i class=\"ti ti-package me-1\"></i>
               <span class=\"item-title\">
                    ";
            // line 280
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Item", "Items", Session::getPluralNumber()), "html", null, true);
            yield "
                </span>
               <span class=\"item-counter badge bg-secondary ms-2\"></span>
               ";
            // line 283
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isMandatoryField", ["items_id"], "method", false, false, false, 283)) {
                // line 284
                yield "                  <span class=\"required\">*</span>
               ";
            }
            // line 286
            yield "            </button>
         </h2>
         <div id=\"items\" class=\"accordion-collapse collapse ";
            // line 288
            yield ((($context["items_show"] ?? null)) ? ("show") : (""));
            yield "\" aria-labelledby=\"items-heading\">
            <div class=\"accordion-body accordion-items row m-0 mt-n2\">
               ";
            // line 290
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item_ticket"] ?? null), "itemAddForm", [($context["item"] ?? null), Twig\Extension\CoreExtension::merge(((array_key_exists("params", $context)) ? (Twig\Extension\CoreExtension::default(($context["params"] ?? null), [])) : ([])), ["entities_id" => ($context["entities_id"] ?? null)])], "method", false, false, false, 290), "html", null, true);
            yield "
            </div>
         </div>
      </div>
   ";
        }
        // line 295
        yield "
   ";
        // line 296
        if ((0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 296), "Ticket"))) {
            // line 297
            yield "      ";
            $context["la_content"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 298
                yield "         ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/service_levels.html.twig");
                yield "
      ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 300
            yield "
      ";
            // line 301
            if ((1 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::trim(($context["la_content"] ?? null))), 0))) {
                // line 302
                yield "         ";
                $context["nb_la"] = ((((((1 === CoreExtension::compare((($__internal_compile_24 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 302)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["slas_id_tto"] ?? null) : null), 0))) ? (1) : (0)) + (((1 === CoreExtension::compare((($__internal_compile_25 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 302)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["slas_id_ttr"] ?? null) : null), 0))) ? (1) : (0))) + (((1 === CoreExtension::compare((($__internal_compile_26 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 302)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["olas_id_tto"] ?? null) : null), 0))) ? (1) : (0))) + (((1 === CoreExtension::compare((($__internal_compile_27 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 302)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["olas_id_ttr"] ?? null) : null), 0))) ? (1) : (0)));
                // line 303
                yield "         ";
                $context["servicelevels_show"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["headers_states"] ?? null), "service-levels", [], "array", true, true, false, 303) && (0 === CoreExtension::compare((($__internal_compile_28 = ($context["headers_states"] ?? null)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["service-levels"] ?? null) : null), "true")))) ? (true) : (false));
                // line 304
                yield "         <div class=\"accordion-item\">
            <h2 class=\"accordion-header\" id=\"service-levels-heading\" title=\"";
                // line 305
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Service level", "Service levels", Session::getPluralNumber()), "html", null, true);
                yield "\" data-bs-toggle=\"tooltip\">
               <button class=\"accordion-button ";
                // line 306
                yield ((($context["servicelevels_show"] ?? null)) ? ("") : ("collapsed"));
                yield "\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#service-levels\" aria-expanded=\"true\" aria-controls=\"service-levels\">
                  <i class=\"ti ti-alarm me-1\"></i>
                  <span class=\"item-title\">
                     ";
                // line 309
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Service level", "Service levels", Session::getPluralNumber()), "html", null, true);
                yield "
                  </span>
                  ";
                // line 311
                if ((1 === CoreExtension::compare(($context["nb_la"] ?? null), 0))) {
                    // line 312
                    yield "                     <span class=\"badge bg-secondary ms-2\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_la"] ?? null), "html", null, true);
                    yield "</span>
                  ";
                }
                // line 314
                yield "               </button>
            </h2>
            <div id=\"service-levels\" class=\"accordion-collapse collapse ";
                // line 316
                yield ((($context["servicelevels_show"] ?? null)) ? ("show") : (""));
                yield "\" aria-labelledby=\"service-levels-heading\">
               <div class=\"accordion-body row m-0 mt-n2\">
                  ";
                // line 318
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["la_content"] ?? null), "html", null, true);
                yield "
               </div>
            </div>
         </div>
      ";
            }
            // line 323
            yield "   ";
        }
        // line 324
        yield "
   ";
        // line 325
        if (CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 325), ["Problem", "Change"])) {
            // line 326
            yield "      ";
            $context["analysis_fields"] = ["impactcontent" => __("Impacts"), "causecontent" => __("Causes"), "symptomcontent" => __("Symptoms"), "controlistcontent" => __("Control list")];
            // line 332
            yield "
      ";
            // line 333
            $context["nb_analysis"] = 0;
            // line 334
            yield "      ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["analysis_fields"] ?? null));
            foreach ($context['_seq'] as $context["analysis_field"] => $context["label"]) {
                // line 335
                yield "         ";
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", [$context["analysis_field"]], "method", false, false, false, 335) && (1 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::trim((($__internal_compile_29 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 335)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29[$context["analysis_field"]] ?? null) : null))), 0)))) {
                    // line 336
                    yield "            ";
                    $context["nb_analysis"] = (($context["nb_analysis"] ?? null) + 1);
                    // line 337
                    yield "         ";
                }
                // line 338
                yield "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['analysis_field'], $context['label'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 339
            yield "      ";
            $context["analysis_show"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["headers_states"] ?? null), "analysis", [], "array", true, true, false, 339) && (0 === CoreExtension::compare((($__internal_compile_30 = ($context["headers_states"] ?? null)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["analysis"] ?? null) : null), "true")))) ? (true) : (false));
            // line 340
            yield "      <div class=\"accordion-item\">
         <h2 class=\"accordion-header\" id=\"analysis-heading\" title=\"";
            // line 341
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Analysis"), "html", null, true);
            yield "\" data-bs-toggle=\"tooltip\">
            <button class=\"accordion-button ";
            // line 342
            yield ((($context["analysis_show"] ?? null)) ? ("") : ("collapsed"));
            yield "\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#analysis\" aria-expanded=\"true\" aria-controls=\"analysis\">
               <i class=\"ti ti-eyeglass me-1\"></i>
               <span class=\"item-title\">
                    ";
            // line 345
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Analysis"), "html", null, true);
            yield "
               </span>
               ";
            // line 347
            if ((1 === CoreExtension::compare(($context["nb_analysis"] ?? null), 0))) {
                // line 348
                yield "                  <span class=\"badge bg-secondary ms-2\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_analysis"] ?? null), "html", null, true);
                yield "</span>
               ";
            }
            // line 350
            yield "            </button>
         </h2>
         <div id=\"analysis\" class=\"accordion-collapse collapse ";
            // line 352
            yield ((($context["analysis_show"] ?? null)) ? ("show") : (""));
            yield "\" aria-labelledby=\"analysis-heading\">
            <div class=\"accordion-body row m-0 mt-n2\">
               ";
            // line 354
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["analysis_fields"] ?? null));
            foreach ($context['_seq'] as $context["analysis_field"] => $context["label"]) {
                // line 355
                yield "                  ";
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", [$context["analysis_field"]], "method", false, false, false, 355)) {
                    // line 356
                    yield "                     ";
                    yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", [                    // line 357
$context["analysis_field"], (($__internal_compile_31 = CoreExtension::getAttribute($this->env, $this->source,                     // line 358
($context["item"] ?? null), "fields", [], "any", false, false, false, 358)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31[$context["analysis_field"]] ?? null) : null),                     // line 359
$context["label"], Twig\Extension\CoreExtension::merge(                    // line 360
($context["field_options"] ?? null), ["enable_richtext" => true, "is_horizontal" => false])], 356, $context, $this->getSourceContext());
                    // line 364
                    yield "
                  ";
                }
                // line 366
                yield "               ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['analysis_field'], $context['label'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 367
            yield "            </div>
         </div>
      </div>
   ";
        }
        // line 371
        yield "
   ";
        // line 372
        if ((0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 372), "Change"))) {
            // line 373
            yield "      ";
            $context["plans_fields"] = ["rolloutplancontent" => __("Deployment plan"), "backoutplancontent" => __("Backup plan"), "checklistcontent" => __("Checklist")];
            // line 378
            yield "
      ";
            // line 379
            $context["nb_plans"] = 0;
            // line 380
            yield "      ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["plans_fields"] ?? null));
            foreach ($context['_seq'] as $context["plans_field"] => $context["label"]) {
                // line 381
                yield "         ";
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", [$context["plans_field"]], "method", false, false, false, 381) && (1 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::trim((($__internal_compile_32 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 381)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32[$context["plans_field"]] ?? null) : null))), 0)))) {
                    // line 382
                    yield "            ";
                    $context["nb_plans"] = (($context["nb_plans"] ?? null) + 1);
                    // line 383
                    yield "         ";
                }
                // line 384
                yield "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['plans_field'], $context['label'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 385
            yield "
      ";
            // line 386
            $context["plans_show"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["headers_states"] ?? null), "plans", [], "array", true, true, false, 386) && (0 === CoreExtension::compare((($__internal_compile_33 = ($context["headers_states"] ?? null)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["plans"] ?? null) : null), "true")))) ? (true) : (false));
            // line 387
            yield "      <div class=\"accordion-item\">
         <h2 class=\"accordion-header\" id=\"plans-heading\" title=\"";
            // line 388
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Plans"), "html", null, true);
            yield "\" data-bs-toggle=\"tooltip\">
            <button class=\"accordion-button ";
            // line 389
            yield ((($context["plans_show"] ?? null)) ? ("") : ("collapsed"));
            yield "\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#plans\" aria-expanded=\"true\" aria-controls=\"plans\">
               <i class=\"ti ti-checkup-list me-1\"></i>
               <span class=\"item-title\">
                    ";
            // line 392
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Plans"), "html", null, true);
            yield "
               </span>
               ";
            // line 394
            if ((1 === CoreExtension::compare(($context["nb_plans"] ?? null), 0))) {
                // line 395
                yield "                  <span class=\"badge bg-secondary ms-2\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_plans"] ?? null), "html", null, true);
                yield "</span>
               ";
            }
            // line 397
            yield "            </button>
         </h2>
         <div id=\"plans\" class=\"accordion-collapse collapse ";
            // line 399
            yield ((($context["plans_show"] ?? null)) ? ("show") : (""));
            yield "\" aria-labelledby=\"plans-heading\">
            <div class=\"accordion-body row m-0 mt-n2\">
               ";
            // line 401
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["plans_fields"] ?? null));
            foreach ($context['_seq'] as $context["plans_field"] => $context["label"]) {
                // line 402
                yield "                  ";
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", [$context["plans_field"]], "method", false, false, false, 402)) {
                    // line 403
                    yield "                     ";
                    yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", [                    // line 404
$context["plans_field"], (($__internal_compile_34 = CoreExtension::getAttribute($this->env, $this->source,                     // line 405
($context["item"] ?? null), "fields", [], "any", false, false, false, 405)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34[$context["plans_field"]] ?? null) : null),                     // line 406
$context["label"], Twig\Extension\CoreExtension::merge(                    // line 407
($context["field_options"] ?? null), ["enable_richtext" => true, "is_horizontal" => false])], 403, $context, $this->getSourceContext());
                    // line 411
                    yield "
                  ";
                }
                // line 413
                yield "               ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['plans_field'], $context['label'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 414
            yield "            </div>
         </div>
      </div>
   ";
        }
        // line 418
        yield "
   ";
        // line 419
        if (($context["ticket_ticket"] ?? null)) {
            // line 420
            yield "      ";
            $context["linked_tickets_show"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["headers_states"] ?? null), "linked_tickets", [], "array", true, true, false, 420) && (0 === CoreExtension::compare((($__internal_compile_35 = ($context["headers_states"] ?? null)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["linked_tickets"] ?? null) : null), "true")))) ? (true) : (false));
            // line 421
            yield "      <div class=\"accordion-item\">
         <h2 class=\"accordion-header\" id=\"linked_tickets-heading\" title=\"";
            // line 422
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Ticket_Ticket", ($context["nb_linked_tickets"] ?? null)), "html", null, true);
            yield "\" data-bs-toggle=\"tooltip\">
            <button class=\"accordion-button ";
            // line 423
            yield ((($context["linked_tickets_show"] ?? null)) ? ("") : ("collapsed"));
            yield "\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#linked_tickets\" aria-expanded=\"true\" aria-controls=\"linked_tickets\">
               <i class=\"ti ti-link me-1\"></i>
               ";
            // line 425
            $context["linked_tickets"] = CoreExtension::getAttribute($this->env, $this->source, ($context["ticket_ticket"] ?? null), "getLinkedTicketsTo", [(($__internal_compile_36 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 425)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["id"] ?? null) : null), true], "method", false, false, false, 425);
            // line 426
            yield "               ";
            $context["nb_linked_tickets"] = Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["linked_tickets"] ?? null));
            // line 427
            yield "               ";
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 427) && (1 === CoreExtension::compare((($__internal_compile_37 = (($__internal_compile_38 = ($context["params"] ?? null)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["_link"] ?? null) : null)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["tickets_id_2"] ?? null) : null), 0)))) {
                // line 428
                yield "                  ";
                $context["nb_linked_tickets"] = 1;
                // line 429
                yield "               ";
            }
            // line 430
            yield "               <span class=\"item-title\">
                    ";
            // line 431
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Ticket_Ticket", ($context["nb_linked_tickets"] ?? null)), "html", null, true);
            yield "
               </span>
               ";
            // line 433
            if ((1 === CoreExtension::compare(($context["nb_linked_tickets"] ?? null), 0))) {
                // line 434
                yield "                  <span class=\"badge bg-secondary ms-2\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_linked_tickets"] ?? null), "html", null, true);
                yield "</span>
               ";
            }
            // line 436
            yield "            </button>
         </h2>
         <div id=\"linked_tickets\" class=\"accordion-collapse collapse ";
            // line 438
            yield ((($context["linked_tickets_show"] ?? null)) ? ("show") : (""));
            yield "\" aria-labelledby=\"linked_tickets-heading\">
            <div class=\"accordion-body\">
               ";
            // line 440
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/linked_tickets.html.twig");
            yield "
            </div>
         </div>
      </div>
   ";
        }
        // line 445
        yield "
    <span class=\"d-none d-md-block\">
        <button type=\"button\" class=\"switch-panel-width btn btn-icon btn-ghost-secondary position-absolute bottom-0 start-0 mb-2\">
            <i class=\"fas fa-caret-left\"></i>
        </button>
    </span>
</div>

<script type=\"text/javascript\">
\$(function() {
   if (\$(window).width() < 768) { // medium breakpoint (Todo check if it's possible to get bootstrap breakpoints withint javascript)
      \$('#itil-data .accordion-collapse').each(function() {
         \$(this).removeClass('show');
      })
   }
});

var reloadCategory = function() {
    var type = \$('[name=type]').val();

    \$('#category_block_";
        // line 465
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield " .field-container').load(
        '";
        // line 466
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("ajax/dropdownTicketCategories.php"), "html", null, true);
        yield "',
        {
            'type': type,
            'entity_restrict': ";
        // line 469
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_39 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 469)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["entities_id"] ?? null) : null), "html", null, true);
        yield ",
            'value': ";
        // line 470
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_40 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 470)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["itilcategories_id"] ?? null) : null), "html", null, true);
        yield ",
        }
    );
};
</script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/fields_panel.html.twig";
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
        return array (  852 => 470,  848 => 469,  842 => 466,  838 => 465,  816 => 445,  808 => 440,  803 => 438,  799 => 436,  793 => 434,  791 => 433,  786 => 431,  783 => 430,  780 => 429,  777 => 428,  774 => 427,  771 => 426,  769 => 425,  764 => 423,  760 => 422,  757 => 421,  754 => 420,  752 => 419,  749 => 418,  743 => 414,  737 => 413,  733 => 411,  731 => 407,  730 => 406,  729 => 405,  728 => 404,  726 => 403,  723 => 402,  719 => 401,  714 => 399,  710 => 397,  704 => 395,  702 => 394,  697 => 392,  691 => 389,  687 => 388,  684 => 387,  682 => 386,  679 => 385,  673 => 384,  670 => 383,  667 => 382,  664 => 381,  659 => 380,  657 => 379,  654 => 378,  651 => 373,  649 => 372,  646 => 371,  640 => 367,  634 => 366,  630 => 364,  628 => 360,  627 => 359,  626 => 358,  625 => 357,  623 => 356,  620 => 355,  616 => 354,  611 => 352,  607 => 350,  601 => 348,  599 => 347,  594 => 345,  588 => 342,  584 => 341,  581 => 340,  578 => 339,  572 => 338,  569 => 337,  566 => 336,  563 => 335,  558 => 334,  556 => 333,  553 => 332,  550 => 326,  548 => 325,  545 => 324,  542 => 323,  534 => 318,  529 => 316,  525 => 314,  519 => 312,  517 => 311,  512 => 309,  506 => 306,  502 => 305,  499 => 304,  496 => 303,  493 => 302,  491 => 301,  488 => 300,  481 => 298,  478 => 297,  476 => 296,  473 => 295,  465 => 290,  460 => 288,  456 => 286,  452 => 284,  450 => 283,  444 => 280,  438 => 277,  434 => 276,  431 => 275,  428 => 274,  426 => 273,  418 => 268,  413 => 266,  406 => 262,  400 => 259,  394 => 256,  390 => 255,  387 => 254,  385 => 253,  377 => 248,  372 => 246,  369 => 245,  365 => 243,  363 => 242,  362 => 240,  360 => 238,  358 => 237,  355 => 236,  351 => 234,  349 => 229,  348 => 228,  347 => 226,  345 => 223,  343 => 222,  340 => 221,  336 => 219,  334 => 216,  333 => 214,  332 => 212,  330 => 209,  328 => 208,  323 => 206,  320 => 205,  316 => 203,  314 => 197,  313 => 195,  311 => 192,  309 => 191,  304 => 189,  299 => 186,  297 => 185,  296 => 183,  295 => 180,  290 => 179,  287 => 178,  284 => 177,  281 => 176,  278 => 175,  275 => 174,  272 => 173,  269 => 172,  266 => 171,  263 => 170,  260 => 169,  257 => 168,  254 => 167,  251 => 164,  248 => 163,  245 => 162,  242 => 159,  239 => 158,  237 => 156,  236 => 155,  235 => 154,  232 => 153,  228 => 151,  226 => 150,  225 => 148,  223 => 146,  220 => 145,  217 => 144,  214 => 143,  211 => 142,  208 => 141,  206 => 140,  205 => 137,  203 => 136,  201 => 135,  198 => 134,  194 => 132,  192 => 131,  191 => 129,  189 => 127,  187 => 126,  184 => 125,  180 => 123,  178 => 122,  177 => 120,  175 => 118,  173 => 117,  170 => 116,  166 => 114,  164 => 113,  163 => 111,  161 => 109,  159 => 108,  155 => 106,  153 => 105,  152 => 103,  151 => 101,  148 => 100,  145 => 99,  141 => 97,  139 => 96,  138 => 94,  136 => 92,  134 => 91,  131 => 90,  127 => 88,  125 => 85,  124 => 83,  123 => 81,  120 => 80,  113 => 78,  110 => 77,  106 => 75,  104 => 72,  103 => 71,  102 => 69,  100 => 66,  97 => 65,  95 => 64,  90 => 62,  84 => 59,  77 => 55,  71 => 52,  65 => 49,  61 => 47,  59 => 46,  55 => 44,  53 => 43,  51 => 42,  48 => 41,  46 => 39,  45 => 38,  44 => 37,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/fields_panel.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\fields_panel.html.twig");
    }
}
