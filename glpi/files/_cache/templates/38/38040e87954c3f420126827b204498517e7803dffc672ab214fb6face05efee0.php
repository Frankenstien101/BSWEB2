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

/* components/form/item_device.html.twig */
class __TwigTemplate_5e7c8986781b160348febd3bb743791e7e2a59a8664fbd4a3afc772ed5ea9ef1 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/form/item_device.html.twig", 34)->unwrap();
        // line 35
        $context["no_header"] = ((array_key_exists("no_header", $context)) ? (Twig\Extension\CoreExtension::default(($context["no_header"] ?? null), ( !CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 35) &&  !((CoreExtension::getAttribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", true, true, false, 35)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", false, false, false, 35), false)) : (false))))) : (( !CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 35) &&  !((CoreExtension::getAttribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", true, true, false, 35)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", false, false, false, 35), false)) : (false)))));
        // line 36
        $context["bg"] = "";
        // line 37
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isDeleted", [], "method", false, false, false, 37)) {
            // line 38
            yield "   ";
            $context["bg"] = "asset-deleted";
        }
        // line 40
        yield "
<div class=\"asset ";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["bg"] ?? null), "html", null, true);
        yield "\">
   ";
        // line 42
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/form/header.html.twig", ["in_twig" => true]);
        yield "

   ";
        // line 44
        $context["params"] = (($context["params"]) ?? ([]));
        // line 45
        yield "   ";
        $context["field_options"] = ["locked_fields" => CoreExtension::getAttribute($this->env, $this->source,         // line 46
($context["item"] ?? null), "getLockedFields", [], "method", false, false, false, 46)];
        // line 48
        yield "
   <div class=\"card-body d-flex flex-wrap\">
      <div class=\"col-12 col-xxl-12 flex-column\">
         <div class=\"d-flex flex-row flex-wrap flex-xl-nowrap\">
            <div class=\"row flex-row align-items-start flex-grow-1\">
               <div class=\"row flex-row\">
                  <script>
                     function showField(item) {
                        // BC - Remove in 10.1
                        showDisclosablePasswordField(item);
                     }
                     function hideField(item) {
                        // BC - Remove in 10.1
                        hideDisclosablePasswordField(item);
                     }
                     function copyToClipboard(item) {
                        // BC - Remove in 10.1
                        copyDisclosablePasswordFieldToClipboard(item);
                     }
                  </script>

                  ";
        // line 69
        $context["field_options"] = Twig\Extension\CoreExtension::merge(($context["field_options"] ?? null), ($context["params"] ?? null));
        // line 70
        yield "
                  <input type=\"hidden\" name=";
        // line 71
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PhpExtension']->getStatic(($context["item"] ?? null), "itemtype_1"), "html", null, true);
        yield " value=";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 71)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[$this->extensions['Glpi\Application\View\Extension\PhpExtension']->getStatic(($context["item"] ?? null), "itemtype_1")] ?? null) : null), "html", null, true);
        yield ">



                  ";
        // line 75
        if (($context["item1"] ?? null)) {
            // line 76
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_htmlField", [$this->extensions['Glpi\Application\View\Extension\PhpExtension']->getStatic(            // line 77
($context["item"] ?? null), "itemtype_1"), CoreExtension::getAttribute($this->env, $this->source,             // line 78
($context["item1"] ?? null), "getLink", [], "method", false, false, false, 78), CoreExtension::getAttribute($this->env, $this->source,             // line 79
($context["item1"] ?? null), "getTypeName", [1], "method", false, false, false, 79),             // line 80
($context["field_options"] ?? null)], 76, $context, $this->getSourceContext());
            // line 81
            yield "
                  ";
        } else {
            // line 83
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_htmlField", ["", __("No associated item"), __("Itemtype"),             // line 87
($context["field_options"] ?? null)], 83, $context, $this->getSourceContext());
            // line 88
            yield "
                  ";
        }
        // line 90
        yield "
                  ";
        // line 91
        if (($context["device"] ?? null)) {
            // line 92
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_htmlField", [$this->extensions['Glpi\Application\View\Extension\PhpExtension']->getStatic(            // line 93
($context["item"] ?? null), "itemtype_2"), CoreExtension::getAttribute($this->env, $this->source,             // line 94
($context["device"] ?? null), "getLink", [], "method", false, false, false, 94), _n("Component", "Components", 1),             // line 96
($context["field_options"] ?? null)], 92, $context, $this->getSourceContext());
            // line 97
            yield "
                  ";
        } else {
            // line 99
            yield "                     ";
            $context["dropdown_itemtype"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("getItemtypeForForeignKeyField", [$this->extensions['Glpi\Application\View\Extension\PhpExtension']->getStatic(($context["item"] ?? null), "items_id_2")]);
            // line 100
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", [            // line 101
($context["dropdown_itemtype"] ?? null), $this->extensions['Glpi\Application\View\Extension\PhpExtension']->getStatic(            // line 102
($context["item"] ?? null), "items_id_2"), (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source,             // line 103
($context["item"] ?? null), "fields", [], "any", false, false, false, 103)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[$this->extensions['Glpi\Application\View\Extension\PhpExtension']->getStatic(($context["item"] ?? null), "items_id_2")] ?? null) : null), _n("Component", "Components", 1),             // line 105
($context["field_options"] ?? null)], 100, $context, $this->getSourceContext());
            // line 106
            yield "
                  ";
        }
        // line 108
        yield "
                  ";
        // line 109
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["specificities_fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["specificities"]) {
            // line 110
            yield "                     ";
            if ((($__internal_compile_2 = $context["specificities"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["canread"] ?? null) : null)) {
                // line 111
                yield "
                        ";
                // line 112
                $context["specific_field_options"] = ($context["field_options"] ?? null);
                // line 113
                yield "                        ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["specificities"], "tooltip", [], "array", true, true, false, 113)) {
                    // line 114
                    yield "                           ";
                    $context["specific_field_options"] = Twig\Extension\CoreExtension::merge(($context["specific_field_options"] ?? null), ["helper" => (($__internal_compile_3 = $context["specificities"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["tooltip"] ?? null) : null)]);
                    // line 115
                    yield "                        ";
                }
                // line 116
                yield "
                        ";
                // line 117
                if ((0 === CoreExtension::compare((($__internal_compile_4 = $context["specificities"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["datatype"] ?? null) : null), "dropdown"))) {
                    // line 118
                    yield "                           ";
                    $context["dropdown_itemtype"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("getItemtypeForForeignKeyField", [(($__internal_compile_5 = $context["specificities"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["field"] ?? null) : null)]);
                    // line 119
                    yield "                           ";
                    yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", [                    // line 120
($context["dropdown_itemtype"] ?? null), (($__internal_compile_6 =                     // line 121
$context["specificities"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["field"] ?? null) : null), (($__internal_compile_7 =                     // line 122
$context["specificities"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["value"] ?? null) : null), (($__internal_compile_8 =                     // line 123
$context["specificities"]) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["label"] ?? null) : null), Twig\Extension\CoreExtension::merge((($__internal_compile_9 =                     // line 124
$context["specificities"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["dropdown_options"] ?? null) : null), ($context["specific_field_options"] ?? null))], 119, $context, $this->getSourceContext());
                    // line 125
                    yield "
                        ";
                } elseif ((($__internal_compile_10 =                 // line 126
$context["specificities"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["protected"] ?? null) : null)) {
                    // line 127
                    yield "                           ";
                    yield CoreExtension::callMacro($macros["fields"], "macro_passwordField", [(($__internal_compile_11 =                     // line 128
$context["specificities"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["field"] ?? null) : null), (($__internal_compile_12 =                     // line 129
$context["specificities"]) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["value"] ?? null) : null), (($__internal_compile_13 =                     // line 130
$context["specificities"]) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["label"] ?? null) : null), Twig\Extension\CoreExtension::merge(                    // line 131
($context["specific_field_options"] ?? null), ["id" => (($__internal_compile_14 =                     // line 132
$context["specificities"]) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["protected_field_id"] ?? null) : null), "is_disclosable" => true])], 127, $context, $this->getSourceContext());
                    // line 135
                    yield "
                        ";
                } elseif ((0 === CoreExtension::compare((($__internal_compile_15 =                 // line 136
$context["specificities"]) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["datatype"] ?? null) : null), "integer"))) {
                    // line 137
                    yield "                           ";
                    yield CoreExtension::callMacro($macros["fields"], "macro_numberField", [(($__internal_compile_16 =                     // line 138
$context["specificities"]) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["field"] ?? null) : null), (($__internal_compile_17 =                     // line 139
$context["specificities"]) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["value"] ?? null) : null), (($__internal_compile_18 =                     // line 140
$context["specificities"]) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["label"] ?? null) : null),                     // line 141
($context["specific_field_options"] ?? null)], 137, $context, $this->getSourceContext());
                    // line 142
                    yield "
                        ";
                } else {
                    // line 144
                    yield "                           ";
                    yield CoreExtension::callMacro($macros["fields"], "macro_textField", [(($__internal_compile_19 =                     // line 145
$context["specificities"]) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["field"] ?? null) : null), (($__internal_compile_20 =                     // line 146
$context["specificities"]) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["value"] ?? null) : null), (($__internal_compile_21 =                     // line 147
$context["specificities"]) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["label"] ?? null) : null),                     // line 148
($context["specific_field_options"] ?? null)], 144, $context, $this->getSourceContext());
                    // line 149
                    yield "
                        ";
                }
                // line 151
                yield "                     ";
            }
            // line 152
            yield "                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['specificities'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 153
        yield "
                  ";
        // line 154
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["serial"], "method", false, false, false, 154)) {
            // line 155
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["serial", (($__internal_compile_22 = CoreExtension::getAttribute($this->env, $this->source,             // line 157
($context["item"] ?? null), "fields", [], "any", false, false, false, 157)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["serial"] ?? null) : null), __("Serial number"),             // line 159
($context["field_options"] ?? null)], 155, $context, $this->getSourceContext());
            // line 160
            yield "
                  ";
        }
        // line 162
        yield "
                  ";
        // line 163
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["otherserial"], "method", false, false, false, 163)) {
            // line 164
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_autoNameField", ["otherserial",             // line 166
($context["item"] ?? null), __("Inventory number"), 0,             // line 169
($context["field_options"] ?? null)], 164, $context, $this->getSourceContext());
            // line 170
            yield "
                  ";
        }
        // line 172
        yield "
                  ";
        // line 173
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["locations_id"], "method", false, false, false, 173)) {
            // line 174
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Location", "locations_id", (($__internal_compile_23 = CoreExtension::getAttribute($this->env, $this->source,             // line 177
($context["item"] ?? null), "fields", [], "any", false, false, false, 177)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["locations_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Location"), Twig\Extension\CoreExtension::merge(            // line 179
($context["field_options"] ?? null), ["entity" => (($__internal_compile_24 = CoreExtension::getAttribute($this->env, $this->source,             // line 180
($context["item"] ?? null), "fields", [], "any", false, false, false, 180)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["entities_id"] ?? null) : null)])], 174, $context, $this->getSourceContext());
            // line 182
            yield "
                  ";
        }
        // line 184
        yield "
                  ";
        // line 185
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["states_id"], "method", false, false, false, 185)) {
            // line 186
            yield "                     ";
            $context["condition"] = ((CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 186), $this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("state_types"))) ? ([("is_visible_" . Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 186))) => 1]) : ([]));
            // line 187
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["State", "states_id", (($__internal_compile_25 = CoreExtension::getAttribute($this->env, $this->source,             // line 190
($context["item"] ?? null), "fields", [], "any", false, false, false, 190)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["states_id"] ?? null) : null), __("Status"), Twig\Extension\CoreExtension::merge(            // line 192
($context["field_options"] ?? null), ["entity" => (($__internal_compile_26 = CoreExtension::getAttribute($this->env, $this->source,             // line 193
($context["item"] ?? null), "fields", [], "any", false, false, false, 193)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["entities_id"] ?? null) : null), "condition" =>             // line 194
($context["condition"] ?? null)])], 187, $context, $this->getSourceContext());
            // line 196
            yield "
                  ";
        }
        // line 198
        yield "
                  ";
        // line 199
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["users_id"], "method", false, false, false, 199)) {
            // line 200
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["User", "users_id", (($__internal_compile_27 = CoreExtension::getAttribute($this->env, $this->source,             // line 203
($context["item"] ?? null), "fields", [], "any", false, false, false, 203)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["users_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("User"), Twig\Extension\CoreExtension::merge(            // line 205
($context["field_options"] ?? null), ["entity" => (($__internal_compile_28 = CoreExtension::getAttribute($this->env, $this->source,             // line 206
($context["item"] ?? null), "fields", [], "any", false, false, false, 206)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["entities_id"] ?? null) : null), "right" => "all"])], 200, $context, $this->getSourceContext());
            // line 209
            yield "
                  ";
        }
        // line 211
        yield "
                  ";
        // line 212
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["groups_id"], "method", false, false, false, 212)) {
            // line 213
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Group", "groups_id", (($__internal_compile_29 = CoreExtension::getAttribute($this->env, $this->source,             // line 216
($context["item"] ?? null), "fields", [], "any", false, false, false, 216)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["groups_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Group"), Twig\Extension\CoreExtension::merge(            // line 218
($context["field_options"] ?? null), ["entity" => (($__internal_compile_30 = CoreExtension::getAttribute($this->env, $this->source,             // line 219
($context["item"] ?? null), "fields", [], "any", false, false, false, 219)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["entities_id"] ?? null) : null), "condition" => ["is_itemgroup" => 1]])], 213, $context, $this->getSourceContext());
            // line 222
            yield "
                  ";
        }
        // line 224
        yield "
                  ";
        // line 225
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isField", ["comment"], "method", false, false, false, 225)) {
            // line 226
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["comment", (($__internal_compile_31 = CoreExtension::getAttribute($this->env, $this->source,             // line 228
($context["item"] ?? null), "fields", [], "any", false, false, false, 228)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["comment"] ?? null) : null), _n("Comment", "Comments", Session::getPluralNumber()),             // line 230
($context["field_options"] ?? null)], 226, $context, $this->getSourceContext());
            // line 231
            yield "
                  ";
        }
        // line 233
        yield "
               </div> ";
        // line 235
        yield "            </div> ";
        // line 236
        yield "         </div> ";
        // line 237
        yield "      </div> ";
        // line 238
        yield "   </div> ";
        // line 239
        yield "

   ";
        // line 241
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/form/buttons.html.twig");
        yield "
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/form/item_device.html.twig";
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
        return array (  368 => 241,  364 => 239,  362 => 238,  360 => 237,  358 => 236,  356 => 235,  353 => 233,  349 => 231,  347 => 230,  346 => 228,  344 => 226,  342 => 225,  339 => 224,  335 => 222,  333 => 219,  332 => 218,  331 => 216,  329 => 213,  327 => 212,  324 => 211,  320 => 209,  318 => 206,  317 => 205,  316 => 203,  314 => 200,  312 => 199,  309 => 198,  305 => 196,  303 => 194,  302 => 193,  301 => 192,  300 => 190,  298 => 187,  295 => 186,  293 => 185,  290 => 184,  286 => 182,  284 => 180,  283 => 179,  282 => 177,  280 => 174,  278 => 173,  275 => 172,  271 => 170,  269 => 169,  268 => 166,  266 => 164,  264 => 163,  261 => 162,  257 => 160,  255 => 159,  254 => 157,  252 => 155,  250 => 154,  247 => 153,  241 => 152,  238 => 151,  234 => 149,  232 => 148,  231 => 147,  230 => 146,  229 => 145,  227 => 144,  223 => 142,  221 => 141,  220 => 140,  219 => 139,  218 => 138,  216 => 137,  214 => 136,  211 => 135,  209 => 132,  208 => 131,  207 => 130,  206 => 129,  205 => 128,  203 => 127,  201 => 126,  198 => 125,  196 => 124,  195 => 123,  194 => 122,  193 => 121,  192 => 120,  190 => 119,  187 => 118,  185 => 117,  182 => 116,  179 => 115,  176 => 114,  173 => 113,  171 => 112,  168 => 111,  165 => 110,  161 => 109,  158 => 108,  154 => 106,  152 => 105,  151 => 103,  150 => 102,  149 => 101,  147 => 100,  144 => 99,  140 => 97,  138 => 96,  137 => 94,  136 => 93,  134 => 92,  132 => 91,  129 => 90,  125 => 88,  123 => 87,  121 => 83,  117 => 81,  115 => 80,  114 => 79,  113 => 78,  112 => 77,  110 => 76,  108 => 75,  99 => 71,  96 => 70,  94 => 69,  71 => 48,  69 => 46,  67 => 45,  65 => 44,  60 => 42,  56 => 41,  53 => 40,  49 => 38,  47 => 37,  45 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/form/item_device.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\form\\item_device.html.twig");
    }
}
