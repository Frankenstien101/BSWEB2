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

/* components/itilobject/timeline/form_validation.html.twig */
class __TwigTemplate_c754e1893323cc8bcb51fba49f9965b9e1a0aed5d9c586220d7295bfcde3fad5 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'timeline_card' => [$this, 'block_timeline_card'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 34
        return "components/itilobject/timeline/form_timeline_item.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/timeline/form_validation.html.twig", 35)->unwrap();
        // line 37
        $context["params"] = ((array_key_exists("params", $context)) ? (Twig\Extension\CoreExtension::default(($context["params"] ?? null), [])) : ([]));
        // line 34
        $this->parent = $this->loadTemplate("components/itilobject/timeline/form_timeline_item.html.twig", "components/itilobject/timeline/form_validation.html.twig", 34);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 39
    public function block_timeline_card($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 40
        yield "   ";
        if ((0 === CoreExtension::compare(($context["form_mode"] ?? null), "view"))) {
            // line 41
            yield "      <div class=\"read-only-content w-100\">
         ";
            // line 42
            yield (($__internal_compile_0 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["content"] ?? null) : null);
            yield "

         ";
            // line 44
            if (Twig\Extension\CoreExtension::length($this->env->getCharset(), (($__internal_compile_1 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["comment_submission"] ?? null) : null))) {
                // line 45
                yield "            <div class='alert alert-info mt-2'>
                <div class='d-flex'>
                    <div><i class='ti ti-quote me-2'></i></div>
                    <div class=\"rich_text_container\">
                        ";
                // line 49
                yield $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getEnhancedHtml((($__internal_compile_2 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["comment_submission"] ?? null) : null), ["user_mentions" => true, "images_gallery" => true]);
                // line 52
                yield "
                    </div>
                </div>
            </div>
         ";
            }
            // line 57
            yield "         ";
            if (Twig\Extension\CoreExtension::length($this->env->getCharset(), (($__internal_compile_3 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["comment_validation"] ?? null) : null))) {
                // line 58
                yield "            <div class='alert alert-info mt-2'>
                <div class='d-flex'>
                    <div><i class='ti ti-quote me-2'></i></div>
                    <div class=\"rich_text_container\">
                        ";
                // line 62
                yield $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getEnhancedHtml((($__internal_compile_4 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["comment_validation"] ?? null) : null), ["user_mentions" => true, "images_gallery" => true]);
                // line 65
                yield "
                    </div>
                </div>
            </div>
         ";
            }
            // line 70
            yield "
         ";
            // line 71
            if ((($__internal_compile_5 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["can_answer"] ?? null) : null)) {
                // line 72
                yield "            <hr class=\"my-2\" />
            <form id=\"validationanswers_id_";
                // line 73
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_6 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["id"] ?? null) : null), "html", null, true);
                yield "\"
                  action=\"";
                // line 74
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath((($__internal_compile_7 = ($context["entry"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["type"] ?? null) : null)), "html", null, true);
                yield "\" method=\"post\" data-submit-once>

               <input type=\"hidden\" name=\"id\" value=\"";
                // line 76
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_8 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["id"] ?? null) : null), "html", null, true);
                yield "\" />
               <input type=\"hidden\" name=\"users_id_validate\" value=\"";
                // line 77
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_9 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["users_id_validate"] ?? null) : null), "html", null, true);
                yield "\" />
               <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
                // line 78
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
                yield "\" />
               ";
                // line 79
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("pre_item_form", ["item" => ($context["subitem"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
                yield "

               <div class=\"mb-3 comment-part\">
                  ";
                // line 82
                yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["comment_validation", "", _n("Comment", "Comments", 1), ["full_width" => true, "enable_richtext" => true, "is_horizontal" => false, "enable_fileupload" => false, "enable_mentions" => true, "entities_id" => (($__internal_compile_10 = CoreExtension::getAttribute($this->env, $this->source,                 // line 92
($context["item"] ?? null), "fields", [], "any", false, false, false, 92)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["entities_id"] ?? null) : null), "rand" =>                 // line 93
($context["rand"] ?? null)]], 82, $context, $this->getSourceContext());
                // line 95
                yield "

                  ";
                // line 97
                yield CoreExtension::callMacro($macros["fields"], "macro_fileField", ["filename", null, "", ["multiple" => true, "full_width" => true, "no_label" => true]], 97, $context, $this->getSourceContext());
                // line 106
                yield "
               </div>

               <div class=\"validation-footer\">
                  <button type=\"submit\" class=\"btn btn-outline-green\" name=\"approval_action\" value=\"approve\">
                     <i class=\"fas fa-thumbs-up\"></i>
                     <span class=\"validation-label\">";
                // line 112
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Approve"), "html", null, true);
                yield "</span>
                  </button>
                  <button type=\"submit\" class=\"btn btn-outline-red\" name=\"approval_action\" value=\"refuse\">
                     <i class=\"fas fa-thumbs-down\"></i>
                     <span class=\"validation-label\">";
                // line 116
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Refuse"), "html", null, true);
                yield "</span>
                  </button>
               </div>
            </form>
         ";
            }
            // line 121
            yield "      </div>
   ";
        } elseif ((0 === CoreExtension::compare(        // line 122
($context["form_mode"] ?? null), "answer"))) {
            // line 123
            yield "      <form name=\"asset_form\" style=\"width: 100%;\" class=\"d-flex flex-column\" method=\"post\"
            action=\"";
            // line 124
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "getFormURL", [], "method", false, false, false, 124), "html", null, true);
            yield "\" enctype=\"multipart/form-data\" data-track-changes=\"true\" data-submit-once>

         <input type=\"hidden\" name=\"id\" value=\"";
            // line 126
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_11 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 126)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["id"] ?? null) : null), "html", null, true);
            yield "\" />
         <input type=\"hidden\" name=\"users_id_validate\" value=\"";
            // line 127
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_12 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 127)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["users_id_validate"] ?? null) : null), "html", null, true);
            yield "\" />
         <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
            // line 128
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
            yield "\" />

         ";
            // line 130
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("pre_item_form", ["item" => ($context["subitem"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
            yield "

         <div class=\"mb-3 comment-part\">
            ";
            // line 133
            yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["comment_validation", (($__internal_compile_13 = CoreExtension::getAttribute($this->env, $this->source,             // line 135
($context["subitem"] ?? null), "fields", [], "any", false, false, false, 135)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["comment_validation"] ?? null) : null), _n("Comment", "Comments", 1), ["full_width" => true, "enable_richtext" => true, "is_horizontal" => false, "enable_fileupload" => false, "enable_mentions" => true, "entities_id" => (($__internal_compile_14 = CoreExtension::getAttribute($this->env, $this->source,             // line 143
($context["item"] ?? null), "fields", [], "any", false, false, false, 143)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["entities_id"] ?? null) : null), "rand" =>             // line 144
($context["rand"] ?? null)]], 133, $context, $this->getSourceContext());
            // line 146
            yield "

            ";
            // line 148
            yield CoreExtension::callMacro($macros["fields"], "macro_fileField", ["filename", null, "", ["multiple" => true, "full_width" => true, "no_label" => true]], 148, $context, $this->getSourceContext());
            // line 157
            yield "
         </div>

         <div class=\"validation-footer\">
            <button type=\"submit\" class=\"btn btn-outline-green\" name=\"approval_action\" value=\"approve\">
               <i class=\"fas fa-thumbs-up\"></i>
               <span class=\"validation-label\">";
            // line 163
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Approve"), "html", null, true);
            yield "</span>
            </button>
            <button type=\"submit\" class=\"btn btn-outline-red\" name=\"approval_action\" value=\"refuse\">
               <i class=\"fas fa-thumbs-down\"></i>
               <span class=\"validation-label\">";
            // line 167
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Refuse"), "html", null, true);
            yield "</span>
            </button>
         </div>
      </form>
   ";
        } else {
            // line 172
            yield "      <div class=\"itilvalidation card mt-4\">
         <form name=\"asset_form\" style=\"width: 100%;\" class=\"d-flex flex-column\" method=\"post\"
               action=\"";
            // line 174
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "getFormURL", [], "method", false, false, false, 174), "html", null, true);
            yield "\" enctype=\"multipart/form-data\" data-track-changes=\"true\" data-submit-once>
            <input type=\"hidden\" name=\"itemtype\" value=\"";
            // line 175
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 175), "html", null, true);
            yield "\" />
            <input type=\"hidden\" name=\"";
            // line 176
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getForeignKeyField", [], "method", false, false, false, 176), "html", null, true);
            yield "\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_15 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 176)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["id"] ?? null) : null), "html", null, true);
            yield "\" />

            <div class=\"card-header\">
                <h3 class=\"cart-title\">";
            // line 179
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Validation request"), "html", null, true);
            yield "</h3>
            </div>
            <div class=\"card-body\">
                ";
            // line 182
            yield CoreExtension::callMacro($macros["fields"], "macro_readOnlyField", ["approval_requester", CoreExtension::getAttribute($this->env, $this->source, $this->extensions['Glpi\Application\View\Extension\SessionExtension']->getCurrentUser(), "getFriendlyName", [], "method", false, false, false, 184), _n("Requester", "Requesters", 1), ["full_width" => true, "rand" =>             // line 188
($context["rand"] ?? null)]], 182, $context, $this->getSourceContext());
            // line 190
            yield "

                ";
            // line 192
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "isNewItem", [], "method", false, false, false, 192)) {
                // line 193
                yield "                    ";
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", ["validatortype", (($__internal_compile_16 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 193)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["validatortype"] ?? null) : null), ["User" => $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("User"), "Group" => $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Group")], __("Approver"), ["display_emptychoice" => true, "rand" =>                 // line 198
($context["rand"] ?? null), "field_class" => "col-12", "label_class" => "col-xxl-4", "input_class" => "col-xxl-8 flex-wrap", "add_field_html" => (("<span id=\"show_validator_field" .                 // line 202
($context["rand"] ?? null)) . "\" class=\"flex-grow-1\">&nbsp;</span>")]], 193, $context, $this->getSourceContext());
                // line 203
                yield "
                    ";
                // line 204
                $context["right"] = "validate";
                // line 205
                yield "                    ";
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 205) === "Ticket")) {
                    // line 206
                    yield "                        ";
                    $context["right"] = (((0 === CoreExtension::compare((($__internal_compile_17 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 206)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["type"] ?? null) : null), 2))) ? ("validate_request") : ("validate_incident"));
                    // line 207
                    yield "                    ";
                }
                // line 208
                yield "                    ";
                if ( !(null === (($__internal_compile_18 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 208)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["validatortype"] ?? null) : null))) {
                    // line 209
                    yield "                    <script type=\"application/javascript\">
                        \$('#show_validator_field";
                    // line 210
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                    yield "').load(CFG_GLPI.root_doc + '/ajax/dropdownValidator.php', {
                            id: ";
                    // line 211
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_19 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 211)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["id"] ?? null) : null), "html", null, true);
                    yield ",
                            entity: ";
                    // line 212
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_20 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 212)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["entities_id"] ?? null) : null), "html", null, true);
                    yield ",
                            right: '";
                    // line 213
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["right"] ?? null), "html", null, true);
                    yield "',
                            validatortype: \"";
                    // line 214
                    yield ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, true, false, 214), "users_id_validate", [], "array", false, true, false, 214), "groups_id", [], "array", true, true, false, 214)) ? ("Group") : ((( !Twig\Extension\CoreExtension::testEmpty((($__internal_compile_21 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 214)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["users_id_validate"] ?? null) : null))) ? ("User") : (""))));
                    yield "\"
                        });
                    </script>
                    ";
                } else {
                    // line 218
                    yield "                        ";
                    $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Ajax::updateItemOnSelectEvent", [("dropdown_validatortype" .                     // line 219
($context["rand"] ?? null)), ("show_validator_field" .                     // line 220
($context["rand"] ?? null)), ($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("root_doc") . "/ajax/dropdownValidator.php"), ["id" => 0, "entity" => (($__internal_compile_22 = CoreExtension::getAttribute($this->env, $this->source,                     // line 224
($context["item"] ?? null), "fields", [], "any", false, false, false, 224)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["entities_id"] ?? null) : null), "right" =>                     // line 225
($context["right"] ?? null), "validatortype" => "__VALUE__", "groups_id" => 0]]);
                    // line 230
                    yield "                    ";
                }
                // line 231
                yield "                ";
            } else {
                // line 232
                yield "                    ";
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["User", "users_id_validate", (($__internal_compile_23 = CoreExtension::getAttribute($this->env, $this->source,                 // line 235
($context["subitem"] ?? null), "fields", [], "any", false, false, false, 235)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["users_id_validate"] ?? null) : null), __("Approver"), ["disabled" => true, "full_width" => true]], 232, $context, $this->getSourceContext());
                // line 241
                yield "
                ";
            }
            // line 243
            yield "
                ";
            // line 244
            yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["comment_submission", (($__internal_compile_24 = CoreExtension::getAttribute($this->env, $this->source,             // line 246
($context["subitem"] ?? null), "fields", [], "any", false, false, false, 246)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["comment_submission"] ?? null) : null), _n("Comment", "Comments", 1), ["full_width" => true, "enable_richtext" => true, "enable_fileupload" => false, "enable_mentions" => true, "entities_id" => (($__internal_compile_25 = CoreExtension::getAttribute($this->env, $this->source,             // line 253
($context["item"] ?? null), "fields", [], "any", false, false, false, 253)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["entities_id"] ?? null) : null), "rand" =>             // line 254
($context["rand"] ?? null)]], 244, $context, $this->getSourceContext());
            // line 256
            yield "

                ";
            // line 258
            yield CoreExtension::callMacro($macros["fields"], "macro_fileField", ["filename", null, "", ["multiple" => true, "full_width" => true]], 258, $context, $this->getSourceContext());
            // line 266
            yield "
            </div>

            ";
            // line 269
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("post_item_form", ["item" => ($context["subitem"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
            yield "

            <div class=\"d-flex justify-content-center card-footer\">
               ";
            // line 272
            if ((0 >= CoreExtension::compare((($__internal_compile_26 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 272)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["id"] ?? null) : null), 0))) {
                // line 273
                yield "                  <button class=\"btn btn-primary me-2\" type=\"submit\" name=\"add\">
                     <i class=\"fas fa-plus\"></i>
                     <span>";
                // line 275
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Add"), "html", null, true);
                yield "</span>
                  </button>
               ";
            } else {
                // line 278
                yield "                  <input type=\"hidden\" name=\"id\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_27 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 278)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["id"] ?? null) : null), "html", null, true);
                yield "\" />
                  <button class=\"btn btn-primary me-2\" type=\"submit\" name=\"update\">
                     <i class=\"far fa-save\"></i>
                     <span>";
                // line 281
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Save"), "html", null, true);
                yield "</span>
                  </button>

                  ";
                // line 284
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "can", [(($__internal_compile_28 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 284)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["id"] ?? null) : null), Twig\Extension\CoreExtension::constant("PURGE")], "method", false, false, false, 284)) {
                    // line 285
                    yield "                     <button class=\"btn btn-outline-danger me-2\" type=\"submit\" name=\"purge\"
                             onclick=\"return confirm('";
                    // line 286
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Confirm the final deletion?"), "html", null, true);
                    yield "');\">
                        <i class=\"fas fa-trash-alt\"></i>
                        <span>";
                    // line 288
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Delete permanently"), "html", null, true);
                    yield "</span>
                     </button>
                  ";
                }
                // line 291
                yield "               ";
            }
            // line 292
            yield "            </div>

            <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
            // line 294
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
            yield "\" />
         </form>
      </div>

      ";
            // line 298
            if (($context["scroll"] ?? null)) {
                // line 299
                yield "         <script type=\"text/javascript\">
            window.scrollTo(0,document.body.scrollHeight);
         </script>
      ";
            }
            // line 303
            yield "   ";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/timeline/form_validation.html.twig";
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
        return array (  428 => 303,  422 => 299,  420 => 298,  413 => 294,  409 => 292,  406 => 291,  400 => 288,  395 => 286,  392 => 285,  390 => 284,  384 => 281,  377 => 278,  371 => 275,  367 => 273,  365 => 272,  359 => 269,  354 => 266,  352 => 258,  348 => 256,  346 => 254,  345 => 253,  344 => 246,  343 => 244,  340 => 243,  336 => 241,  334 => 235,  332 => 232,  329 => 231,  326 => 230,  324 => 225,  323 => 224,  322 => 220,  321 => 219,  319 => 218,  312 => 214,  308 => 213,  304 => 212,  300 => 211,  296 => 210,  293 => 209,  290 => 208,  287 => 207,  284 => 206,  281 => 205,  279 => 204,  276 => 203,  274 => 202,  273 => 198,  271 => 193,  269 => 192,  265 => 190,  263 => 188,  262 => 182,  256 => 179,  248 => 176,  244 => 175,  240 => 174,  236 => 172,  228 => 167,  221 => 163,  213 => 157,  211 => 148,  207 => 146,  205 => 144,  204 => 143,  203 => 135,  202 => 133,  196 => 130,  191 => 128,  187 => 127,  183 => 126,  178 => 124,  175 => 123,  173 => 122,  170 => 121,  162 => 116,  155 => 112,  147 => 106,  145 => 97,  141 => 95,  139 => 93,  138 => 92,  137 => 82,  131 => 79,  127 => 78,  123 => 77,  119 => 76,  114 => 74,  110 => 73,  107 => 72,  105 => 71,  102 => 70,  95 => 65,  93 => 62,  87 => 58,  84 => 57,  77 => 52,  75 => 49,  69 => 45,  67 => 44,  62 => 42,  59 => 41,  56 => 40,  52 => 39,  47 => 34,  45 => 37,  43 => 35,  36 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/form_validation.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\form_validation.html.twig");
    }
}
