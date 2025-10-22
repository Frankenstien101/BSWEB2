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

/* components/itilobject/timeline/form_task.html.twig */
class __TwigTemplate_0e4fa5db08c0962d28ce1045c09a93f77e6fd976c02569dc18418e94da5759c1 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/timeline/form_task.html.twig", 35)->unwrap();
        // line 37
        $context["params"] = Twig\Extension\CoreExtension::merge(["parent" => ($context["item"] ?? null)], ((array_key_exists("params", $context)) ? (Twig\Extension\CoreExtension::default(($context["params"] ?? null), [])) : ([])));
        // line 39
        $context["candedit"] = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "maySolve", [], "method", false, false, false, 39);
        // line 40
        $context["can_read_kb"] = (Session::haveRight("knowbase", Twig\Extension\CoreExtension::constant("READ")) || Session::haveRight("knowbase", Twig\Extension\CoreExtension::constant("KnowbaseItem::READFAQ")));
        // line 41
        $context["can_update_kb"] = Session::haveRight("knowbase", Twig\Extension\CoreExtension::constant("UPDATE"));
        // line 42
        $context["nokb"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "nokb", [], "array", true, true, false, 42) || (0 === CoreExtension::compare((($__internal_compile_0 = ($context["params"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["nokb"] ?? null) : null), true)));
        // line 43
        $context["rand"] = Twig\Extension\CoreExtension::random($this->env->getCharset());
        // line 44
        $context["formoptions"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "formoptions", [], "array", true, true, false, 44) &&  !(null === (($__internal_compile_1 = ($context["params"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["formoptions"] ?? null) : null)))) ? ((($__internal_compile_2 = ($context["params"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["formoptions"] ?? null) : null)) : (""));
        // line 34
        $this->parent = $this->loadTemplate("components/itilobject/timeline/form_timeline_item.html.twig", "components/itilobject/timeline/form_task.html.twig", 34);
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
            yield "      <div class=\"read-only-content ";
            yield ((((($__internal_compile_3 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["state"] ?? null) : null) === constant("Planning::DONE"))) ? ("done") : (""));
            yield "\">
         <div class=\"rich_text_container text-content\" data-bs-html=\"true\" data-bs-custom-class=\"todo-list-tooltip\"
              title=\"";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getTextFromHtml((($__internal_compile_4 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["content"] ?? null) : null)), "html", null, true);
            yield "\" data-bs-toggle=\"tooltip\">
            ";
            // line 51
            yield $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getEnhancedHtml((($__internal_compile_5 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["content"] ?? null) : null), ["user_mentions" => true, "images_gallery" => true]);
            // line 54
            yield "
         </div>

         <div class=\"timeline-badges\">
            ";
            // line 58
            if ((($__internal_compile_6 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["users_id_tech"] ?? null) : null)) {
                // line 59
                yield "               <span class=\"badge bg-orange-lt\">
                  ";
                // line 60
                $context["is_current_tech"] = (0 === CoreExtension::compare((($__internal_compile_7 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["users_id_tech"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiID")));
                // line 61
                yield "                  ";
                $context["anonym_tech"] = (((0 === CoreExtension::compare($this->extensions['Glpi\Application\View\Extension\SessionExtension']->getCurrentInterface(), "helpdesk")) &&  !($context["is_current_tech"] ?? null)) && (0 !== CoreExtension::compare($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->getEntityConfig("anonymize_support_agents", $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactive_entity")), Twig\Extension\CoreExtension::constant("Entity::ANONYMIZE_DISABLED"))));
                // line 62
                yield "                  ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, "components/user/link_with_tooltip.html.twig", ["users_id" => (($__internal_compile_8 =                 // line 63
($context["entry_i"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["users_id_tech"] ?? null) : null), "enable_anonymization" =>                 // line 64
($context["anonym_tech"] ?? null)], false);
                // line 65
                yield "
               </span>
            ";
            }
            // line 68
            yield "
            ";
            // line 69
            if ((($__internal_compile_9 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["groups_id_tech"] ?? null) : null)) {
                // line 70
                yield "               <span class=\"badge bg-orange-lt\">
                  <i class=\"fas fa-users me-1\"></i>
                  ";
                // line 72
                yield $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemLink("Group", (($__internal_compile_10 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["groups_id_tech"] ?? null) : null), ["enable_anonymization" => true]);
                yield "
               </span>
            ";
            }
            // line 75
            yield "
            ";
            // line 76
            if ((($__internal_compile_11 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["taskcategories_id"] ?? null) : null)) {
                // line 77
                yield "               <span class=\"badge bg-orange-lt\">
                  ";
                // line 78
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemName("TaskCategory", (($__internal_compile_12 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["taskcategories_id"] ?? null) : null)), "html", null, true);
                yield "
               </span>
            ";
            }
            // line 81
            yield "
            ";
            // line 82
            if ((($__internal_compile_13 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["actiontime"] ?? null) : null)) {
                // line 83
                yield "               <span class=\"actiontime badge bg-orange-lt\">
                  <i class=\"fas fa-stopwatch me-1\"></i>
                  ";
                // line 85
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDuration((($__internal_compile_14 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["actiontime"] ?? null) : null)), "html", null, true);
                yield "
               </span>
            ";
            }
            // line 88
            yield "
            ";
            // line 89
            if ((($__internal_compile_15 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["begin"] ?? null) : null)) {
                // line 90
                yield "               <span class=\"planification badge bg-orange-lt\">
                  <i class=\"fas fa-calendar me-1\"></i>
                  ";
                // line 92
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_16 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["begin"] ?? null) : null)), "html", null, true);
                yield "
                  &rArr;
                  ";
                // line 94
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_17 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["end"] ?? null) : null)), "html", null, true);
                yield "
               </span>
            ";
            }
            // line 97
            yield "
            ";
            // line 98
            if ((($__internal_compile_18 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["sourceitems_id"] ?? null) : null)) {
                // line 99
                yield "               <span class=\"badge bg-blue-lt\">
                  <i class=\"fas fa-code-branch me-1\"></i>
                  ";
                // line 101
                $context["merged_badge"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 102
                    yield "                     <span class=\"badge ms-2 me-n2\">
                        ";
                    // line 103
                    yield $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemLink("Ticket", (($__internal_compile_19 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["sourceitems_id"] ?? null) : null));
                    yield "
                     </span>
                  ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 106
                yield "                  ";
                yield Twig\Extension\CoreExtension::sprintf(__("Merged from Ticket %1\$s"), ($context["merged_badge"] ?? null));
                yield "
               </span>
            ";
            }
            // line 109
            yield "
            ";
            // line 110
            if ((($__internal_compile_20 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["sourceof_items_id"] ?? null) : null)) {
                // line 111
                yield "               <span class=\"badge bg-blue-lt\">
                  <i class=\"fas fa-code-branch me-1\"></i>
                  ";
                // line 113
                $context["promoted_badge"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 114
                    yield "                     <span class=\"badge ms-2 me-n2\">
                        ";
                    // line 115
                    yield $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemLink("Ticket", (($__internal_compile_21 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["sourceof_items_id"] ?? null) : null));
                    yield "
                     </span>
                  ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 118
                yield "                  ";
                yield Twig\Extension\CoreExtension::sprintf(__("Promoted to Ticket %1\$s"), ($context["promoted_badge"] ?? null));
                yield "
               </span>
            ";
            }
            // line 121
            yield "
            ";
            // line 122
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/pending_reasons_messages.html.twig");
            yield "
         </div>
      </div>

      <script type=\"text/javascript\">
         function change_task_state(tasks_id, target) {
            \$.post('";
            // line 128
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/timeline.php"), "html", null, true);
            yield "',
               {'action':     'change_task_state',
                  'tasks_id':   tasks_id,
                  'parenttype': '";
            // line 131
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 131), "html", null, true);
            yield "',
                  '";
            // line 132
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getForeignKeyField", [], "method", false, false, false, 132), "html", null, true);
            yield "': ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_22 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 132)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["id"] ?? null) : null), "html", null, true);
            yield "
               })
               .done(function(response) {
                  \$(target).closest('.timeline-item').find('.state')
                     .removeClass('state_1 state_2')
                     .addClass('state_'+response.state)
                     .attr('title', response.label);

                  \$(target).closest('.timeline-item').find('.read-only-content')
                     .toggleClass('done');

                  var todo_tasks   = \$('.todo-list-state .state.state_1').length;
                  var done_tasks   = \$('.todo-list-state .state.state_2').length;
                  var total_tasks  = todo_tasks + done_tasks;
                  var percent_done = Math.floor(100 * done_tasks / total_tasks);

                  \$('.timeline-progress')
                     .css('width', percent_done + '%')
                     .attr('aria-valuenow', percent_done);
                  \$('.task-progress-label').html(percent_done + '%');
               });
         }
      </script>
   ";
        } else {
            // line 156
            yield "      <div class=\"itiltask\">
         <form name=\"asset_form\" style=\"width: 100%;\" class=\"d-flex flex-column\" method=\"post\"
               action=\"";
            // line 158
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "getFormURL", [], "method", false, false, false, 158), "html", null, true);
            yield "\"  enctype=\"multipart/form-data\" data-track-changes=\"true\" data-submit-once ";
            yield ($context["formoptions"] ?? null);
            yield ">
            <input type=\"hidden\" name=\"itemtype\" value=\"";
            // line 159
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 159), "html", null, true);
            yield "\" />
            <input type=\"hidden\" name=\"";
            // line 160
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getForeignKeyField", [], "method", false, false, false, 160), "html", null, true);
            yield "\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_23 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 160)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["id"] ?? null) : null), "html", null, true);
            yield "\" />
            ";
            // line 161
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("pre_item_form", ["item" => ($context["subitem"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
            yield "

            <div class=\"row mx-n3 mx-xxl-auto\">
               <div class=\"col-12 col-xl-7 col-xxl-8\">
                  ";
            // line 165
            yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["content", (($__internal_compile_24 = CoreExtension::getAttribute($this->env, $this->source,             // line 167
($context["subitem"] ?? null), "fields", [], "any", false, false, false, 167)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["content"] ?? null) : null), "", ["full_width" => true, "no_label" => true, "enable_richtext" => true, "enable_fileupload" => true, "enable_mentions" => true, "entities_id" => (($__internal_compile_25 = CoreExtension::getAttribute($this->env, $this->source,             // line 175
($context["item"] ?? null), "fields", [], "any", false, false, false, 175)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["entities_id"] ?? null) : null), "rand" =>             // line 176
($context["rand"] ?? null)]], 165, $context, $this->getSourceContext());
            // line 178
            yield "
               </div>
               <div class=\"col-12 col-xl-5 col-xxl-4 order-first order-md-last pe-0 pe-xxl-auto\">
                  <div class=\"row\">

                     ";
            // line 183
            $context["task_template_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 184
                yield "                        <i class=\"fas fa-reply fa-fw me-1\"
                           title=\"";
                // line 185
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Task template", "Task templates", Session::getPluralNumber()), "html", null, true);
                yield "\"></i>
                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 187
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["TaskTemplate", "tasktemplates_id", (($__internal_compile_26 = CoreExtension::getAttribute($this->env, $this->source,             // line 190
($context["subitem"] ?? null), "fields", [], "any", false, false, false, 190)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["tasktemplates_id"] ?? null) : null),             // line 191
($context["task_template_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "on_change" => (("itiltasktemplate_update" .             // line 195
($context["rand"] ?? null)) . "(this.value)"), "entity" => (($__internal_compile_27 = CoreExtension::getAttribute($this->env, $this->source,             // line 196
($context["item"] ?? null), "fields", [], "any", false, false, false, 196)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["entities_id"] ?? null) : null), "rand" =>             // line 197
($context["rand"] ?? null)]], 187, $context, $this->getSourceContext());
            // line 199
            yield "

                     ";
            // line 201
            $context["task_date_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 202
                yield "                        <i class=\"fas fa-calendar fa-fw me-1\"
                           title=\"";
                // line 203
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Date", "Dates", 1), "html", null, true);
                yield "\"></i>
                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 205
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_datetimeField", ["date", (($__internal_compile_28 = CoreExtension::getAttribute($this->env, $this->source,             // line 207
($context["subitem"] ?? null), "fields", [], "any", false, false, false, 207)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["date"] ?? null) : null),             // line 208
($context["task_date_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "rand" =>             // line 212
($context["rand"] ?? null)]], 205, $context, $this->getSourceContext());
            // line 214
            yield "

                     ";
            // line 217
            yield "                     ";
            $context["task_category_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 218
                yield "                        <i class=\"fas fa-tag fa-fw me-1\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Category", "Categories", 1), "html", null, true);
                yield "\"></i>
                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 220
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["TaskCategory", "taskcategories_id", (($__internal_compile_29 = CoreExtension::getAttribute($this->env, $this->source,             // line 223
($context["subitem"] ?? null), "fields", [], "any", false, false, false, 223)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["taskcategories_id"] ?? null) : null),             // line 224
($context["task_category_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "entity" => (($__internal_compile_30 = CoreExtension::getAttribute($this->env, $this->source,             // line 228
($context["item"] ?? null), "fields", [], "any", false, false, false, 228)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["entities_id"] ?? null) : null), "condition" => ["is_active" => 1], "rand" =>             // line 232
($context["rand"] ?? null)]], 220, $context, $this->getSourceContext());
            // line 234
            yield "

                     ";
            // line 237
            yield "                     ";
            $context["task_state_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 238
                yield "                        <i class=\"fas fa-tasks fa-fw me-1\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Status"), "html", null, true);
                yield "\"></i>
                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 240
            yield "
                     ";
            // line 241
            $context["task_state"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 242
                yield "                        ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Planning::dropdownState", ["state", (($__internal_compile_31 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 242)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["state"] ?? null) : null), true, ["rand" => ($context["rand"] ?? null)]]);
                // line 243
                yield "                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 244
            yield "
                     ";
            // line 245
            yield CoreExtension::callMacro($macros["fields"], "macro_htmlField", ["state",             // line 247
($context["task_state"] ?? null),             // line 248
($context["task_state_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "rand" =>             // line 252
($context["rand"] ?? null)]], 245, $context, $this->getSourceContext());
            // line 254
            yield "

                     ";
            // line 256
            $context["task_private_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 257
                yield "                        <i class=\"ti ti-lock fa-fw me-1\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Private"), "html", null, true);
                yield "\"></i>
                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 259
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_sliderField", ["is_private", (($__internal_compile_32 = CoreExtension::getAttribute($this->env, $this->source,             // line 261
($context["subitem"] ?? null), "fields", [], "any", false, false, false, 261)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["is_private"] ?? null) : null),             // line 262
($context["task_private_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "rand" =>             // line 266
($context["rand"] ?? null)]], 259, $context, $this->getSourceContext());
            // line 268
            yield "

                     ";
            // line 270
            if ((($context["can_read_kb"] ?? null) && (1 === CoreExtension::compare(($context["kb_id_toload"] ?? null), 0)))) {
                // line 271
                yield "                        ";
                $context["link_kb_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 272
                    yield "                           <i class=\"fas fa-link fa-fw me-1\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"
                              title=\"";
                    // line 273
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::replace(__("Link to knowledge base entry #%id"), ["%id" => ($context["kb_id_toload"] ?? null)]), "html", null, true);
                    yield "\"></i>
                        ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 275
                yield "                        ";
                yield CoreExtension::callMacro($macros["fields"], "macro_sliderField", ["kb_linked_id", 1,                 // line 278
($context["link_kb_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "rand" =>                 // line 282
($context["rand"] ?? null), "yes_value" =>                 // line 283
($context["kb_id_toload"] ?? null)]], 275, $context, $this->getSourceContext());
                // line 285
                yield "
                     ";
            }
            // line 287
            yield "
                     ";
            // line 288
            if (((($context["candedit"] ?? null) && ($context["can_update_kb"] ?? null)) &&  !($context["nokb"] ?? null))) {
                // line 289
                yield "                        ";
                $context["task_to_kb_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 290
                    yield "                           <i class=\"far fa-save fa-fw me-1\" title=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Save and add to the knowledge base"), "html", null, true);
                    yield "\"
                              data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"></i>
                        ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 293
                yield "                        ";
                yield CoreExtension::callMacro($macros["fields"], "macro_sliderField", ["_task_to_kb", 0,                 // line 296
($context["task_to_kb_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "rand" =>                 // line 300
($context["rand"] ?? null)]], 293, $context, $this->getSourceContext());
                // line 302
                yield "
                     ";
            }
            // line 304
            yield "
                     ";
            // line 306
            yield "                     ";
            $context["task_actiontime_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 307
                yield "                        <i class=\"fas fa-stopwatch fa-fw me-1\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Duration"), "html", null, true);
                yield "\"></i>
                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 309
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownTimestampField", ["actiontime", (($__internal_compile_33 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 309)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["actiontime"] ?? null) : null), ($context["task_actiontime_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "rand" =>             // line 312
($context["rand"] ?? null), "min" => 0, "max" => (8 * Twig\Extension\CoreExtension::constant("HOUR_TIMESTAMP")), "addfirstminutes" => true, "inhours" => true, "toadd" => Twig\Extension\CoreExtension::map($this->env, range(9, 100),             // line 317
function ($__i__) use ($context, $macros) { $context["i"] = $__i__; return (($context["i"] ?? null) * Twig\Extension\CoreExtension::constant("HOUR_TIMESTAMP")); })]], 309, $context, $this->getSourceContext());
            // line 318
            yield "

                     ";
            // line 321
            yield "                     ";
            $context["task_user_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 322
                yield "                        <i class=\"fas fa-user fa-fw me-1\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("User"), "html", null, true);
                yield "\"></i>
                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 324
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["User", "users_id_tech", ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 327
($context["subitem"] ?? null), "fields", [], "any", false, true, false, 327), "users_id_tech", [], "array", true, true, false, 327)) ? (Twig\Extension\CoreExtension::default((($__internal_compile_34 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, true, false, 327)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["users_id_tech"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiID"))) : ($this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiID"))),             // line 328
($context["task_user_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "entity" => (($__internal_compile_35 = CoreExtension::getAttribute($this->env, $this->source,             // line 332
($context["item"] ?? null), "fields", [], "any", false, false, false, 332)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["entities_id"] ?? null) : null), "right" => "own_ticket", "rand" =>             // line 334
($context["rand"] ?? null)]], 324, $context, $this->getSourceContext());
            // line 336
            yield "

                     ";
            // line 339
            yield "                     ";
            $context["task_group_lbl"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 340
                yield "                        <i class=\"fas fa-users fa-fw me-1\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Group"), "html", null, true);
                yield "\"></i>
                     ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 342
            yield "                     ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Group", "groups_id_tech", (($__internal_compile_36 = CoreExtension::getAttribute($this->env, $this->source,             // line 345
($context["subitem"] ?? null), "fields", [], "any", false, false, false, 345)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["groups_id_tech"] ?? null) : null),             // line 346
($context["task_group_lbl"] ?? null), ["full_width" => true, "icon_label" => true, "entity" => (($__internal_compile_37 = CoreExtension::getAttribute($this->env, $this->source,             // line 350
($context["item"] ?? null), "fields", [], "any", false, false, false, 350)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["entities_id"] ?? null) : null), "condition" => ["is_task" => 1], "rand" =>             // line 352
($context["rand"] ?? null)]], 342, $context, $this->getSourceContext());
            // line 354
            yield "

                     <script type=\"text/javascript\">
                        function showPlanUpdate";
            // line 357
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "(e) {
                           \$('#plan";
            // line 358
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "').hide();
                           \$('#viewplan";
            // line 359
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "').load('";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/planning.php"), "html", null, true);
            yield "', {
                              action: \"add_event_classic_form\",
                              form: \"followups\", // Was followups for tasks before. Can't find where this is used.
                              entity: ";
            // line 362
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_38 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 362)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["entities_id"] ?? null) : null), "html", null, true);
            yield ",
                              rand_user: ";
            // line 363
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::random($this->env->getCharset()), "html", null, true);
            yield ",
                              rand_group: ";
            // line 364
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::random($this->env->getCharset()), "html", null, true);
            yield ",
                              itemtype: \"";
            // line 365
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "type", [], "any", false, false, false, 365), "html", null, true);
            yield "\",
                              items_id: ";
            // line 366
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, true, false, 366), "id", [], "array", true, true, false, 366)) ? (Twig\Extension\CoreExtension::default((($__internal_compile_39 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, true, false, 366)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["id"] ?? null) : null),  -1)) : ( -1)), "html", null, true);
            yield ",
                              parent_itemtype: \"";
            // line 367
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 367), "html", null, true);
            yield "\",
                              parent_items_id: ";
            // line 368
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_40 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 368)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["id"] ?? null) : null), "html", null, true);
            yield ",
                              parent_fk_field: \"";
            // line 369
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getForeignKeyField", [], "method", false, false, false, 369), "html", null, true);
            yield "\",
                              begin: \"";
            // line 370
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_41 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 370)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41["begin"] ?? null) : null), "html", null, true);
            yield "\",
                              end: \"";
            // line 371
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_42 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 371)) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42["end"] ?? null) : null), "html", null, true);
            yield "\",
                           });
                        }
                     </script>
                     <div class=\"col-12\">
                        ";
            // line 376
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "can", [(($__internal_compile_43 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 376)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43["id"] ?? null) : null), Twig\Extension\CoreExtension::constant("UPDATE")], "method", false, false, false, 376) && (($__internal_compile_44 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 376)) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44["begin"] ?? null) : null))) {
                // line 377
                yield "                           <script type=\"text/javascript\">
                              showPlanUpdate";
                // line 378
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                yield "();
                           </script>
                           <button id=\"unplan";
                // line 380
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                yield "\" class=\"btn btn-outline-warning\" type=\"submit\" name=\"unplan\"
                                 onclick=\"return confirm('";
                // line 381
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Confirm the deletion of planning?"), "html", null, true);
                yield "');\">
                              <i class=\"fas ti ti-calendar-off\"></i>
                              <span>";
                // line 383
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Unplan"), "html", null, true);
                yield "</span>
                           </button>
                        ";
            } else {
                // line 386
                yield "                           <button id=\"plan";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                yield "\" class=\"btn btn-outline-secondary text-truncate\" onclick=\"showPlanUpdate";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                yield "()\" type=\"button\">
                              <i class=\"fas fa-calendar\"></i>
                              <span>";
                // line 388
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Plan this task"), "html", null, true);
                yield "</span>
                           </button>
                        ";
            }
            // line 391
            yield "                        <div id=\"viewplan";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\"></div>
                     </div>
                  </div>
               </div>
            </div>

            ";
            // line 397
            $context["pending_reasons"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 398
                yield "               ";
                $context["show_pending_reasons_actions"] = ((0 === CoreExtension::compare((($__internal_compile_45 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 398)) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45["status"] ?? null) : null), Twig\Extension\CoreExtension::constant("CommonITILObject::WAITING"))) &&  !($context["has_pending_reason"] ?? null));
                // line 399
                yield "               ";
                if ($this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PendingReason_Item::canDisplayPendingReasonForItem", [($context["subitem"] ?? null)])) {
                    // line 400
                    yield "                  <span
                     class=\"input-group-text bg-yellow-lt py-0 pe-0 ";
                    // line 401
                    yield ((($context["show_pending_reasons_actions"] ?? null)) ? ("flex-fill") : (""));
                    yield "\"
                     id=\"pending-reasons-control-";
                    // line 402
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                    yield "\"
                  >
                     <span class=\"d-inline-flex align-items-center\" title=\"";
                    // line 404
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Set the status to pending"), "html", null, true);
                    yield "\"
                           data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" role=\"button\">
                        <i class=\"fas fa-pause me-2\"></i>
                        <label class=\"form-check form-switch mt-2\">
                           <input type=\"hidden\"   name=\"pending\" value=\"0\" />
                           <input type=\"checkbox\" name=\"pending\" value=\"1\" class=\"form-check-input\"
                                 id=\"enable-pending-reasons-";
                    // line 410
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                    yield "\"
                                 role=\"button\"
                                 ";
                    // line 412
                    yield (((0 === CoreExtension::compare((($__internal_compile_46 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 412)) && is_array($__internal_compile_46) || $__internal_compile_46 instanceof ArrayAccess ? ($__internal_compile_46["status"] ?? null) : null), Twig\Extension\CoreExtension::constant("CommonITILObject::WAITING")))) ? ("checked") : (""));
                    yield "
                                 data-bs-toggle=\"collapse\" data-bs-target=\"#pending-reasons-setup-";
                    // line 413
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                    yield "\" />
                        </label>
                     </span>

                     ";
                    // line 417
                    if ( !($context["has_pending_reason"] ?? null)) {
                        // line 418
                        yield "                        <div
                           class=\"collapse ps-2 py-1 flex-fill ";
                        // line 419
                        yield ((($context["show_pending_reasons_actions"] ?? null)) ? ("show") : (""));
                        yield "\"
                           aria-expanded=\"";
                        // line 420
                        yield ((($context["show_pending_reasons_actions"] ?? null)) ? ("true") : ("false"));
                        yield "\"
                           id=\"pending-reasons-setup-";
                        // line 421
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                        yield "\"
                        >
                           ";
                        // line 423
                        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/pending_reasons.html.twig");
                        yield "
                        </div>
                     ";
                    }
                    // line 426
                    yield "                  </span>
               ";
                }
                // line 428
                yield "            ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 429
            yield "
            ";
            // line 430
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("post_item_form", ["item" => ($context["subitem"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
            yield "
            ";
            // line 432
            yield "            <div class=\"d-flex card-footer mx-n3 mb-n3 flex-wrap\" style=\"row-gap: 10px; min-height: 79px\">
               ";
            // line 433
            if ((0 >= CoreExtension::compare((($__internal_compile_47 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 433)) && is_array($__internal_compile_47) || $__internal_compile_47 instanceof ArrayAccess ? ($__internal_compile_47["id"] ?? null) : null), 0))) {
                // line 434
                yield "                  ";
                // line 435
                yield "                  <div class=\"input-group flex-nowrap\">
                     <button class=\"btn btn-primary\" type=\"submit\" name=\"add\">
                        <i class=\"fas fa-plus\"></i>
                        <span>";
                // line 438
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Add"), "html", null, true);
                yield "</span>
                     </button>
                     ";
                // line 440
                yield ($context["pending_reasons"] ?? null);
                yield "
                  </div>
               ";
            } else {
                // line 443
                yield "                  <input type=\"hidden\" name=\"id\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_48 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 443)) && is_array($__internal_compile_48) || $__internal_compile_48 instanceof ArrayAccess ? ($__internal_compile_48["id"] ?? null) : null), "html", null, true);
                yield "\" />
                  <button class=\"btn btn-primary me-2\" type=\"submit\" name=\"update\">
                     <i class=\"far fa-save\"></i>
                     <span>";
                // line 446
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Save"), "html", null, true);
                yield "</span>
                  </button>

                  ";
                // line 449
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "can", [(($__internal_compile_49 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 449)) && is_array($__internal_compile_49) || $__internal_compile_49 instanceof ArrayAccess ? ($__internal_compile_49["id"] ?? null) : null), Twig\Extension\CoreExtension::constant("PURGE")], "method", false, false, false, 449)) {
                    // line 450
                    yield "                     <button class=\"btn btn-outline-danger me-2\" type=\"submit\" name=\"purge\"
                             onclick=\"return confirm('";
                    // line 451
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Confirm the final deletion?"), "html", null, true);
                    yield "');\">
                        <i class=\"fas fa-trash-alt\"></i>
                        <span>";
                    // line 453
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Delete permanently"), "html", null, true);
                    yield "</span>
                     </button>
                  ";
                }
                // line 456
                yield "                  ";
                yield ($context["pending_reasons"] ?? null);
                yield "
               ";
            }
            // line 458
            yield "            </div>

            <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
            // line 460
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
            yield "\" />
         </form>
      </div>

      <script type=\"text/javascript\">
         function itiltasktemplate_update";
            // line 465
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "(value) {
            \$.ajax({
               url: '";
            // line 467
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/task.php"), "html", null, true);
            yield "',
               type: 'POST',
               data: {
                  tasktemplates_id: value,
                  items_id: '";
            // line 471
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_50 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 471)) && is_array($__internal_compile_50) || $__internal_compile_50 instanceof ArrayAccess ? ($__internal_compile_50["id"] ?? null) : null), "html", null, true);
            yield "',
                  itemtype: '";
            // line 472
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 472), "html", null, true);
            yield "'
               }
            }).done(function (data) {
                if (data.content !== undefined) {
                    // set textarea content
                    setRichTextEditorContent(\"content_";
            // line 477
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\", data.content);
                }

                if (data.taskcategories_id !== undefined) {
                    // set category
                    const taskcategories_id = isNaN(parseInt(data.taskcategories_id))
                        ? 0
                        : parseInt(data.taskcategories_id);

                     //need to create new DOM option, because SELECT is remotely-sourced (AJAX)
                     //see : https://select2.org/programmatic-control/add-select-clear-items#preselecting-options-in-an-remotely-sourced-ajax-select2
                     var newOption = new Option(data.taskcategories_name, taskcategories_id, true, true);
                     \$(\"#dropdown_taskcategories_id";
            // line 489
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\").append(newOption).trigger('change');
                }

                if (data.is_private !== undefined) {
                    // set is_private
                    \$(\"#is_private_";
            // line 494
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\")
                        .prop(\"checked\", data.is_private == \"0\"
                            ? false
                            : true);
                }

                if (data.state !== undefined) {
                    // Set state
                    \$(\"#dropdown_state";
            // line 502
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\").trigger('setValue', data.state);
                }

                if (data.actiontime !== undefined) {
                    // Set duration
                    \$(\"#dropdown_actiontime";
            // line 507
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\").trigger('setValue', data.actiontime);
                }

                if (data.users_id_tech !== undefined) {
                    // Set user
                    \$(\"#dropdown_users_id_tech";
            // line 512
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\").trigger('setValue', data.users_id_tech);
                }

               if (data.groups_id_tech !== undefined) {
                   // Set group
                   \$(\"#dropdown_groups_id_tech";
            // line 517
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\").trigger('setValue', data.groups_id_tech);
               }
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
        return "components/itilobject/timeline/form_task.html.twig";
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
        return array (  896 => 517,  888 => 512,  880 => 507,  872 => 502,  861 => 494,  853 => 489,  838 => 477,  830 => 472,  826 => 471,  819 => 467,  814 => 465,  806 => 460,  802 => 458,  796 => 456,  790 => 453,  785 => 451,  782 => 450,  780 => 449,  774 => 446,  767 => 443,  761 => 440,  756 => 438,  751 => 435,  749 => 434,  747 => 433,  744 => 432,  740 => 430,  737 => 429,  733 => 428,  729 => 426,  723 => 423,  718 => 421,  714 => 420,  710 => 419,  707 => 418,  705 => 417,  698 => 413,  694 => 412,  689 => 410,  680 => 404,  675 => 402,  671 => 401,  668 => 400,  665 => 399,  662 => 398,  660 => 397,  650 => 391,  644 => 388,  636 => 386,  630 => 383,  625 => 381,  621 => 380,  616 => 378,  613 => 377,  611 => 376,  603 => 371,  599 => 370,  595 => 369,  591 => 368,  587 => 367,  583 => 366,  579 => 365,  575 => 364,  571 => 363,  567 => 362,  559 => 359,  555 => 358,  551 => 357,  546 => 354,  544 => 352,  543 => 350,  542 => 346,  541 => 345,  539 => 342,  532 => 340,  529 => 339,  525 => 336,  523 => 334,  522 => 332,  521 => 328,  520 => 327,  518 => 324,  511 => 322,  508 => 321,  504 => 318,  502 => 317,  501 => 312,  499 => 309,  492 => 307,  489 => 306,  486 => 304,  482 => 302,  480 => 300,  479 => 296,  477 => 293,  469 => 290,  466 => 289,  464 => 288,  461 => 287,  457 => 285,  455 => 283,  454 => 282,  453 => 278,  451 => 275,  445 => 273,  442 => 272,  439 => 271,  437 => 270,  433 => 268,  431 => 266,  430 => 262,  429 => 261,  427 => 259,  420 => 257,  418 => 256,  414 => 254,  412 => 252,  411 => 248,  410 => 247,  409 => 245,  406 => 244,  402 => 243,  399 => 242,  397 => 241,  394 => 240,  387 => 238,  384 => 237,  380 => 234,  378 => 232,  377 => 228,  376 => 224,  375 => 223,  373 => 220,  366 => 218,  363 => 217,  359 => 214,  357 => 212,  356 => 208,  355 => 207,  353 => 205,  347 => 203,  344 => 202,  342 => 201,  338 => 199,  336 => 197,  335 => 196,  334 => 195,  333 => 191,  332 => 190,  330 => 187,  324 => 185,  321 => 184,  319 => 183,  312 => 178,  310 => 176,  309 => 175,  308 => 167,  307 => 165,  300 => 161,  294 => 160,  290 => 159,  284 => 158,  280 => 156,  251 => 132,  247 => 131,  241 => 128,  232 => 122,  229 => 121,  222 => 118,  215 => 115,  212 => 114,  210 => 113,  206 => 111,  204 => 110,  201 => 109,  194 => 106,  187 => 103,  184 => 102,  182 => 101,  178 => 99,  176 => 98,  173 => 97,  167 => 94,  162 => 92,  158 => 90,  156 => 89,  153 => 88,  147 => 85,  143 => 83,  141 => 82,  138 => 81,  132 => 78,  129 => 77,  127 => 76,  124 => 75,  118 => 72,  114 => 70,  112 => 69,  109 => 68,  104 => 65,  102 => 64,  101 => 63,  99 => 62,  96 => 61,  94 => 60,  91 => 59,  89 => 58,  83 => 54,  81 => 51,  77 => 50,  71 => 48,  68 => 47,  64 => 46,  59 => 34,  57 => 44,  55 => 43,  53 => 42,  51 => 41,  49 => 40,  47 => 39,  45 => 37,  43 => 35,  36 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/form_task.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\form_task.html.twig");
    }
}
