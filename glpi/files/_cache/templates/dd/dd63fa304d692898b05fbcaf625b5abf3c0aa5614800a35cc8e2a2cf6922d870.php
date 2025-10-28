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

/* components/itilobject/timeline/form_solution.html.twig */
class __TwigTemplate_036209132f2eed452ea855dbe430382f4a9e373424e39a2b67680c1a6b52b308 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/timeline/form_solution.html.twig", 35)->unwrap();
        // line 37
        $context["params"] = Twig\Extension\CoreExtension::merge(["item" => ($context["item"] ?? null)], ((array_key_exists("params", $context)) ? (Twig\Extension\CoreExtension::default(($context["params"] ?? null), [])) : ([])));
        // line 39
        $context["candedit"] = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "maySolve", [], "method", false, false, false, 39);
        // line 40
        $context["can_read_kb"] = (Session::haveRight("knowbase", Twig\Extension\CoreExtension::constant("READ")) || Session::haveRight("knowbase", Twig\Extension\CoreExtension::constant("KnowbaseItem::READFAQ")));
        // line 41
        $context["can_update_kb"] = Session::haveRight("knowbase", Twig\Extension\CoreExtension::constant("UPDATE"));
        // line 42
        $context["nokb"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "nokb", [], "array", true, true, false, 42) || (0 === CoreExtension::compare((($__internal_compile_0 = ($context["params"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["nokb"] ?? null) : null), true)));
        // line 43
        $context["noform"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "noform", [], "array", true, true, false, 43) || (0 === CoreExtension::compare((($__internal_compile_1 = ($context["params"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["noform"] ?? null) : null), true)));
        // line 44
        $context["disabled"] = (0 === CoreExtension::compare(($context["candedit"] ?? null), false));
        // line 34
        $this->parent = $this->loadTemplate("components/itilobject/timeline/form_timeline_item.html.twig", "components/itilobject/timeline/form_solution.html.twig", 34);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 46
    public function block_timeline_card($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 47
        yield "   ";
        if ((0 === CoreExtension::compare(($context["form_mode"] ?? null), "view"))) {
            // line 48
            yield "      <div class=\"read-only-content\">
         <div class= \"rich_text_container\">
            ";
            // line 50
            yield $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getEnhancedHtml((($__internal_compile_2 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["content"] ?? null) : null), ["user_mentions" => true, "images_gallery" => true]);
            // line 53
            yield "
         </div>

         <div class=\"timeline-badges\">
            ";
            // line 57
            if ((($__internal_compile_3 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["solutiontypes_id"] ?? null) : null)) {
                // line 58
                yield "               <span class=\"badge bg-blue-lt\">
                  <i class=\"fas fa-tag me-1\"></i>
                  ";
                // line 60
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemName("SolutionType", (($__internal_compile_4 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["solutiontypes_id"] ?? null) : null)), "html", null, true);
                yield "
               </span>
            ";
            }
            // line 63
            yield "
            ";
            // line 64
            if (((0 !== CoreExtension::compare((($__internal_compile_5 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["status"] ?? null) : null), Twig\Extension\CoreExtension::constant("CommonITILValidation::WAITING"))) && (0 !== CoreExtension::compare((($__internal_compile_6 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["status"] ?? null) : null), Twig\Extension\CoreExtension::constant("CommonITILValidation::NONE"))))) {
                // line 65
                yield "               <span class=\"badge bg-blue-lt\">
                  ";
                // line 66
                $context["action"] = (((0 === CoreExtension::compare((($__internal_compile_7 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["status"] ?? null) : null), Twig\Extension\CoreExtension::constant("CommonITILValidation::ACCEPTED")))) ? (__("Accepted")) : (_x("validation", "Refused")));
                // line 67
                yield "                  ";
                yield Twig\Extension\CoreExtension::sprintf(__("%1\$s on %2\$s by %3\$s"),                 // line 68
($context["action"] ?? null), $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_8 =                 // line 69
($context["entry_i"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["date_approval"] ?? null) : null)), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemLink("User", (($__internal_compile_9 =                 // line 70
($context["entry_i"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["users_id_approval"] ?? null) : null), ["enable_anonymization" => true]));
                // line 71
                yield "
               </span>
            ";
            }
            // line 74
            yield "         </div>
      </div>
   ";
        } else {
            // line 77
            yield "      <div class=\"itilsolution\">
         ";
            // line 78
            $context["validation_class"] = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getValidationClassInstance", [], "method", false, false, false, 78);
            // line 79
            yield "         ";
            if ( !(null === ($context["validation_class"] ?? null))) {
                // line 80
                yield "            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["validation_class"] ?? null), "alertValidation", [($context["item"] ?? null), "solution"], "method", false, false, false, 80), "html", null, true);
                yield "
         ";
            }
            // line 82
            yield "
         ";
            // line 83
            if ( !($context["noform"] ?? null)) {
                // line 84
                yield "         <form name=\"asset_form\" style=\"width: 100%;\" class=\"d-flex flex-column\" method=\"post\"
               action=\"";
                // line 85
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "getFormURL", [], "method", false, false, false, 85), "html", null, true);
                yield "\" enctype=\"multipart/form-data\" data-track-changes=\"true\" data-submit-once>
         ";
            }
            // line 87
            yield "
            <input type=\"hidden\" name=\"itemtype\" value=\"";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 88), "html", null, true);
            yield "\" />
            <input type=\"hidden\" name=\"items_id\" value=\"";
            // line 89
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_10 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 89)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["id"] ?? null) : null), "html", null, true);
            yield "\" />
            <input type=\"hidden\" name=\"_no_message_link\" value=\"1\" />
            ";
            // line 91
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("pre_item_form", ["item" => ($context["subitem"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
            yield "

            ";
            // line 93
            if ((1 === CoreExtension::compare($this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Ticket_Ticket::countOpenChildren", [(($__internal_compile_11 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 93)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["id"] ?? null) : null)]), 0))) {
                // line 94
                yield "               <div class=\"alert alert-important alert-warning\">
                  <i class=\"fas fa-2x fa-info me-2\"></i>
                  <span>";
                // line 96
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Warning: non closed children tickets depends on current ticket. Are you sure you want to close it?"), "html", null, true);
                yield "</span>
               </div>
            ";
            }
            // line 99
            yield "
            <div class=\"row mx-n3 mx-xxl-auto\">
               <div class=\"col-12 col-xl-7 col-xxl-8\">
                  ";
            // line 102
            $context["content"] = (($__internal_compile_12 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 102)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["content"] ?? null) : null);
            // line 103
            yield "                  ";
            if ((1 === CoreExtension::compare(($context["kb_id_toload"] ?? null), 0))) {
                // line 104
                yield "                     ";
                $context["kb_item"] = $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItem("KnowbaseItem", ($context["kb_id_toload"] ?? null));
                // line 105
                yield "                     ";
                $context["content"] = (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["kb_item"] ?? null), "fields", [], "any", false, true, false, 105), "answer", [], "array", true, true, false, 105) &&  !(null === (($__internal_compile_13 = CoreExtension::getAttribute($this->env, $this->source, ($context["kb_item"] ?? null), "fields", [], "any", false, true, false, 105)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["answer"] ?? null) : null)))) ? ((($__internal_compile_14 = CoreExtension::getAttribute($this->env, $this->source, ($context["kb_item"] ?? null), "fields", [], "any", false, true, false, 105)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["answer"] ?? null) : null)) : (""));
                // line 106
                yield "                  ";
            }
            // line 107
            yield "
                  ";
            // line 108
            yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["content",             // line 110
($context["content"] ?? null), "", ["full_width" => true, "no_label" => true, "enable_richtext" => true, "enable_fileupload" => true, "enable_mentions" => true, "entities_id" => (($__internal_compile_15 = CoreExtension::getAttribute($this->env, $this->source,             // line 118
($context["item"] ?? null), "fields", [], "any", false, false, false, 118)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["entities_id"] ?? null) : null), "rand" =>             // line 119
($context["rand"] ?? null), "disabled" =>             // line 120
($context["disabled"] ?? null)]], 108, $context, $this->getSourceContext());
            // line 122
            yield "
               </div>
               <div class=\"col-12 col-xl-5 col-xxl-4 order-first order-md-last pe-0 pe-xxl-auto\">
                  <div class=\"row\">
                     ";
            // line 126
            if (($context["candedit"] ?? null)) {
                // line 127
                yield "                        ";
                if ((($context["can_read_kb"] ?? null) &&  !($context["nokb"] ?? null))) {
                    // line 128
                    yield "                           ";
                    $context["search_solution_button"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                        // line 129
                        yield "                              <a href=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path((((("/front/knowbaseitem.php?item_itemtype=" . CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 129)) . "&item_items_id=") . CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getID", [], "method", false, false, false, 129)) . "&forcetab=Knowbase\$1")), "html", null, true);
                        yield "\"
                                 class=\"btn btn-secondary overflow-hidden text-nowrap\" type=\"submit\"
                                 title=\"";
                        // line 131
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Search a solution"), "html", null, true);
                        yield "\"
                                 data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
                                 <i class=\"fas fa-search\"></i>
                              </a>
                           ";
                        return; yield '';
                    })())) ? '' : new Markup($tmp, $this->env->getCharset());
                    // line 136
                    yield "                           ";
                    yield CoreExtension::callMacro($macros["fields"], "macro_field", ["",                     // line 138
($context["search_solution_button"] ?? null), "", ["full_width" => true, "icon_label" => true]], 136, $context, $this->getSourceContext());
                    // line 144
                    yield "
                        ";
                }
                // line 146
                yield "
                        ";
                // line 147
                $context["sol_template_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 148
                    yield "                           <i class=\"fas fa-reply fa-fw me-1\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"
                              title=\"";
                    // line 149
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Solution template", "Solution templates", Session::getPluralNumber()), "html", null, true);
                    yield "\"></i>
                        ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 151
                yield "                        ";
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["SolutionTemplate", "solutiontemplates_id", 0,                 // line 155
($context["sol_template_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "on_change" => (("solutiontemplate_update" .                 // line 159
($context["rand"] ?? null)) . "(this.value)"), "rand" =>                 // line 160
($context["rand"] ?? null), "entity" => (($__internal_compile_16 = CoreExtension::getAttribute($this->env, $this->source,                 // line 161
($context["item"] ?? null), "fields", [], "any", false, false, false, 161)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["entities_id"] ?? null) : null), "disabled" =>                 // line 162
($context["disabled"] ?? null)]], 151, $context, $this->getSourceContext());
                // line 164
                yield "

                     ";
            }
            // line 167
            yield "
                     ";
            // line 168
            $context["sol_type_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 169
                yield "                        <i class=\"fas fa-tag fa-fw me-1\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("SolutionType"), "html", null, true);
                yield "\"
                           data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"></i>
                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 172
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["SolutionType", "solutiontypes_id", (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 175
($context["subitem"] ?? null), "fields", [], "any", false, true, false, 175), "solutiontypes_id", [], "array", true, true, false, 175) &&  !(null === (($__internal_compile_17 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, true, false, 175)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["solutiontypes_id"] ?? null) : null)))) ? ((($__internal_compile_18 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, true, false, 175)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["solutiontypes_id"] ?? null) : null)) : (0)),             // line 176
($context["sol_type_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "rand" =>             // line 180
($context["rand"] ?? null), "entity" => (($__internal_compile_19 = CoreExtension::getAttribute($this->env, $this->source,             // line 181
($context["item"] ?? null), "fields", [], "any", false, false, false, 181)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["entities_id"] ?? null) : null), "disabled" =>             // line 182
($context["disabled"] ?? null)]], 172, $context, $this->getSourceContext());
            // line 184
            yield "

                     ";
            // line 186
            if ((($context["can_read_kb"] ?? null) && (1 === CoreExtension::compare(($context["kb_id_toload"] ?? null), 0)))) {
                // line 187
                yield "                        ";
                $context["link_kb_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 188
                    yield "                           <i class=\"fas fa-link fa-fw me-1\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"
                              title=\"";
                    // line 189
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::replace(__("Link to knowledge base entry #%id"), ["%id" => ($context["kb_id_toload"] ?? null)]), "html", null, true);
                    yield "\"></i>
                        ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 191
                yield "                        ";
                yield CoreExtension::callMacro($macros["fields"], "macro_sliderField", ["kb_linked_id", 1,                 // line 194
($context["link_kb_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "rand" =>                 // line 198
($context["rand"] ?? null), "yes_value" =>                 // line 199
($context["kb_id_toload"] ?? null)]], 191, $context, $this->getSourceContext());
                // line 201
                yield "
                     ";
            }
            // line 203
            yield "
                     ";
            // line 204
            if (((($context["candedit"] ?? null) && ($context["can_update_kb"] ?? null)) &&  !($context["nokb"] ?? null))) {
                // line 205
                yield "                        ";
                $context["sol_to_kb_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 206
                    yield "                           <i class=\"far fa-save fa-fw me-1\" title=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Save and add to the knowledge base"), "html", null, true);
                    yield "\"
                              data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"></i>
                        ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 209
                yield "                        ";
                yield CoreExtension::callMacro($macros["fields"], "macro_sliderField", ["_sol_to_kb", 0,                 // line 212
($context["sol_to_kb_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "rand" =>                 // line 216
($context["rand"] ?? null)]], 209, $context, $this->getSourceContext());
                // line 218
                yield "
                     ";
            }
            // line 220
            yield "                  </div>
               </div>
            </div>

         ";
            // line 224
            if ( !($context["noform"] ?? null)) {
                // line 225
                yield "               ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("post_item_form", ["item" => ($context["subitem"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
                yield "
               <div class=\"d-flex card-footer mx-n3 mb-n3\">
                  ";
                // line 227
                if ((0 >= CoreExtension::compare((($__internal_compile_20 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 227)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["id"] ?? null) : null), 0))) {
                    // line 228
                    yield "                     <button class=\"btn btn-primary me-2\" type=\"submit\" name=\"add\">
                        <i class=\"fas fa-plus\"></i>
                        <span>";
                    // line 230
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Add"), "html", null, true);
                    yield "</span>
                     </button>
                  ";
                } else {
                    // line 233
                    yield "                     <input type=\"hidden\" name=\"id\" value=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_21 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 233)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["id"] ?? null) : null), "html", null, true);
                    yield "\" />
                     <button class=\"btn btn-primary me-2\" type=\"submit\" name=\"update\">
                        <i class=\"far fa-save\"></i>
                        <span>";
                    // line 236
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Save"), "html", null, true);
                    yield "</span>
                     </button>
                  ";
                }
                // line 239
                yield "               </div>

               <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
                // line 241
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
                yield "\" />
            </form>
         ";
            }
            // line 244
            yield "      </div>

      <script type=\"text/javascript\">
         function solutiontemplate_update";
            // line 247
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "(value) {
            \$.ajax({
               url: '";
            // line 249
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/solution.php"), "html", null, true);
            yield "',
               type: 'POST',
               data: {
                  solutiontemplates_id: value,
                  items_id: '";
            // line 253
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_22 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 253)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["id"] ?? null) : null), "html", null, true);
            yield "',
                  itemtype: '";
            // line 254
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 254), "html", null, true);
            yield "'
               }
            }).done(function (data) {
               // set textarea content
               setRichTextEditorContent(\"content_";
            // line 258
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\", data.content);

               // set type
               var solutiontypes_id = isNaN(parseInt(data.solutiontypes_id))
                  ? 0
                  : parseInt(data.solutiontypes_id);

               //need to create new DOM option, because SELECT is remotely-sourced (AJAX)
               //see : https://select2.org/programmatic-control/add-select-clear-items#preselecting-options-in-an-remotely-sourced-ajax-select2
               var newOption = new Option(data.solutiontypes_name, solutiontypes_id, true, true);
               \$(\"#dropdown_solutiontypes_id";
            // line 268
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\").append(newOption).trigger('change');
            });
         }
      </script>
   ";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/timeline/form_solution.html.twig";
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
        return array (  433 => 268,  420 => 258,  413 => 254,  409 => 253,  402 => 249,  397 => 247,  392 => 244,  386 => 241,  382 => 239,  376 => 236,  369 => 233,  363 => 230,  359 => 228,  357 => 227,  351 => 225,  349 => 224,  343 => 220,  339 => 218,  337 => 216,  336 => 212,  334 => 209,  326 => 206,  323 => 205,  321 => 204,  318 => 203,  314 => 201,  312 => 199,  311 => 198,  310 => 194,  308 => 191,  302 => 189,  299 => 188,  296 => 187,  294 => 186,  290 => 184,  288 => 182,  287 => 181,  286 => 180,  285 => 176,  284 => 175,  282 => 172,  274 => 169,  272 => 168,  269 => 167,  264 => 164,  262 => 162,  261 => 161,  260 => 160,  259 => 159,  258 => 155,  256 => 151,  250 => 149,  247 => 148,  245 => 147,  242 => 146,  238 => 144,  236 => 138,  234 => 136,  225 => 131,  219 => 129,  216 => 128,  213 => 127,  211 => 126,  205 => 122,  203 => 120,  202 => 119,  201 => 118,  200 => 110,  199 => 108,  196 => 107,  193 => 106,  190 => 105,  187 => 104,  184 => 103,  182 => 102,  177 => 99,  171 => 96,  167 => 94,  165 => 93,  160 => 91,  155 => 89,  151 => 88,  148 => 87,  143 => 85,  140 => 84,  138 => 83,  135 => 82,  129 => 80,  126 => 79,  124 => 78,  121 => 77,  116 => 74,  111 => 71,  109 => 70,  108 => 69,  107 => 68,  105 => 67,  103 => 66,  100 => 65,  98 => 64,  95 => 63,  89 => 60,  85 => 58,  83 => 57,  77 => 53,  75 => 50,  71 => 48,  68 => 47,  64 => 46,  59 => 34,  57 => 44,  55 => 43,  53 => 42,  51 => 41,  49 => 40,  47 => 39,  45 => 37,  43 => 35,  36 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/form_solution.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\form_solution.html.twig");
    }
}
