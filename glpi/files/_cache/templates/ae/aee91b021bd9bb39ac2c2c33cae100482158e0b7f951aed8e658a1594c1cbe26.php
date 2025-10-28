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

/* components/itilobject/timeline/timeline.html.twig */
class __TwigTemplate_3555319845c2403376643ee401cf1f71e7ef8751121b802fdc8b39781a4f6efa extends Template
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
        $context["is_timeline_reversed"] = (0 === CoreExtension::compare($this->extensions['Glpi\Application\View\Extension\SessionExtension']->userPref("timeline_order"), Twig\Extension\CoreExtension::constant("CommonITILObject::TIMELINE_ORDER_REVERSE")));
        // line 35
        yield "
<div class=\"itil-timeline d-flex flex-column align-items-start mb-auto\">
    ";
        // line 37
        if ( !($context["is_timeline_reversed"] ?? null)) {
            // line 38
            yield "        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/main_description.html.twig");
            yield "
    ";
        } else {
            // line 40
            yield "        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/approbation_form.html.twig");
            yield "
        ";
            // line 41
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/answer.html.twig");
            yield "
    ";
        }
        // line 43
        yield "
   ";
        // line 44
        $context["status_closed"] = CoreExtension::inFilter((($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 44)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["status"] ?? null) : null), CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getClosedStatusArray", [], "method", false, false, false, 44));
        // line 45
        yield "
   ";
        // line 47
        yield "   ";
        $context["user_cache"] = [];
        // line 48
        yield "
   ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["timeline"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["entry"]) {
            // line 50
            yield "      ";
            $context["entry_i"] = (($__internal_compile_1 = $context["entry"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["item"] ?? null) : null);
            // line 51
            yield "      ";
            $context["entry_object"] = (((CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "object", [], "array", true, true, false, 51) &&  !(null === (($__internal_compile_2 = $context["entry"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["object"] ?? null) : null)))) ? ((($__internal_compile_3 = $context["entry"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["object"] ?? null) : null)) : ($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItem((($__internal_compile_4 = $context["entry"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["type"] ?? null) : null), (($__internal_compile_5 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["id"] ?? null) : null))));
            // line 52
            yield "      ";
            $context["users_id"] = (($__internal_compile_6 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["users_id"] ?? null) : null);
            // line 53
            yield "      ";
            $context["is_private"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["entry_i"] ?? null), "is_private", [], "array", true, true, false, 53) &&  !(null === (($__internal_compile_7 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["is_private"] ?? null) : null)))) ? ((($__internal_compile_8 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["is_private"] ?? null) : null)) : (false));
            // line 54
            yield "      ";
            $context["date_creation"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["entry_i"] ?? null), "date_creation", [], "array", true, true, false, 54) &&  !(null === (($__internal_compile_9 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["date_creation"] ?? null) : null)))) ? ((($__internal_compile_10 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["date_creation"] ?? null) : null)) : ((($__internal_compile_11 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["date"] ?? null) : null)));
            // line 55
            yield "      ";
            $context["date_mod"] = (($__internal_compile_12 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["date_mod"] ?? null) : null);
            // line 56
            yield "      ";
            $context["entry_rand"] = Twig\Extension\CoreExtension::random($this->env->getCharset());
            // line 57
            yield "      ";
            $context["is_current_user"] = (0 === CoreExtension::compare(($context["users_id"] ?? null), $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiID")));
            // line 58
            yield "      ";
            $context["anonym_user"] = (((0 === CoreExtension::compare($this->extensions['Glpi\Application\View\Extension\SessionExtension']->getCurrentInterface(), "helpdesk")) &&  !($context["is_current_user"] ?? null)) && (0 !== CoreExtension::compare($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->getEntityConfig("anonymize_support_agents", $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactive_entity")), Twig\Extension\CoreExtension::constant("Entity::ANONYMIZE_DISABLED"))));
            // line 59
            yield "
      ";
            // line 60
            $context["can_edit_i"] = (($__internal_compile_13 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["can_edit"] ?? null) : null);
            // line 61
            yield "
      ";
            // line 62
            $context["timeline_position"] = (($__internal_compile_14 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["timeline_position"] ?? null) : null);
            // line 63
            yield "      ";
            $context["item_position"] = "t-left";
            // line 64
            yield "      ";
            if ((0 === CoreExtension::compare(($context["timeline_position"] ?? null), Twig\Extension\CoreExtension::constant("CommonITILObject::TIMELINE_LEFT")))) {
                // line 65
                yield "         ";
                $context["item_position"] = "t-left";
                // line 66
                yield "      ";
            } elseif ((0 === CoreExtension::compare(($context["timeline_position"] ?? null), Twig\Extension\CoreExtension::constant("CommonITILObject::TIMELINE_MIDLEFT")))) {
                // line 67
                yield "         ";
                $context["item_position"] = "t-left t-middle";
                // line 68
                yield "      ";
            } elseif ((0 === CoreExtension::compare(($context["timeline_position"] ?? null), Twig\Extension\CoreExtension::constant("CommonITILObject::TIMELINE_MIDRIGHT")))) {
                // line 69
                yield "         ";
                $context["item_position"] = "t-right t-middle";
                // line 70
                yield "      ";
            } elseif ((0 === CoreExtension::compare(($context["timeline_position"] ?? null), Twig\Extension\CoreExtension::constant("CommonITILObject::TIMELINE_RIGHT")))) {
                // line 71
                yield "         ";
                $context["item_position"] = "t-right";
                // line 72
                yield "      ";
            }
            // line 73
            yield "
      ";
            // line 74
            $context["itiltype"] = ((CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "itiltype", [], "array", true, true, false, 74)) ? (("ITIL" . (($__internal_compile_15 = $context["entry"]) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["itiltype"] ?? null) : null))) : ((($__internal_compile_16 = $context["entry"]) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["type"] ?? null) : null)));
            // line 75
            yield "
      ";
            // line 76
            $context["state_class"] = "";
            // line 77
            yield "      ";
            if (((($__internal_compile_17 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["state"] ?? null) : null) === constant("Planning::INFO"))) {
                // line 78
                yield "         ";
                $context["state_class"] = "info";
                // line 79
                yield "      ";
            }
            // line 80
            yield "      ";
            if (((($__internal_compile_18 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["state"] ?? null) : null) === constant("Planning::TODO"))) {
                // line 81
                yield "         ";
                $context["state_class"] = "todo";
                // line 82
                yield "      ";
            }
            // line 83
            yield "      ";
            if (((($__internal_compile_19 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["state"] ?? null) : null) === constant("Planning::DONE"))) {
                // line 84
                yield "         ";
                $context["state_class"] = "done";
                // line 85
                yield "      ";
            }
            // line 86
            yield "
      ";
            // line 87
            $context["solution_class"] = "";
            // line 88
            yield "      ";
            if ((((0 === CoreExtension::compare(($context["itiltype"] ?? null), "ITILSolution")) || (0 === CoreExtension::compare(($context["itiltype"] ?? null), "ITILValidation"))) && CoreExtension::getAttribute($this->env, $this->source, ($context["entry_i"] ?? null), "status", [], "array", true, true, false, 88))) {
                // line 89
                yield "         ";
                $context["status"] = (((0 === CoreExtension::compare(($context["itiltype"] ?? null), "ITILSolution"))) ? ((($__internal_compile_20 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["status"] ?? null) : null)) : (Twig\Extension\CoreExtension::replace((($__internal_compile_21 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["status"] ?? null) : null), ["status_" => ""])));
                // line 90
                yield "         ";
                if ((0 === CoreExtension::compare(($context["status"] ?? null), Twig\Extension\CoreExtension::constant("CommonITILValidation::WAITING")))) {
                    // line 91
                    yield "            ";
                    $context["solution_class"] = "waiting";
                    // line 92
                    yield "         ";
                }
                // line 93
                yield "         ";
                if ((0 === CoreExtension::compare(($context["status"] ?? null), Twig\Extension\CoreExtension::constant("CommonITILValidation::ACCEPTED")))) {
                    // line 94
                    yield "            ";
                    $context["solution_class"] = "accepted";
                    // line 95
                    yield "         ";
                }
                // line 96
                yield "         ";
                if ((0 === CoreExtension::compare(($context["status"] ?? null), Twig\Extension\CoreExtension::constant("CommonITILValidation::REFUSED")))) {
                    // line 97
                    yield "            ";
                    $context["solution_class"] = "refused";
                    // line 98
                    yield "         ";
                }
                // line 99
                yield "      ";
            }
            // line 100
            yield "
      ";
            // line 102
            yield "      ";
            // line 103
            yield "      ";
            $context["entry_user"] = (((array_key_exists("users_id", $context) &&  !(null === ($context["users_id"] ?? null)))) ? ((((CoreExtension::getAttribute($this->env, $this->source, ($context["user_cache"] ?? null), ("_" . ($context["users_id"] ?? null)), [], "array", true, true, false, 103) &&  !(null === (($__internal_compile_22 = ($context["user_cache"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22[("_" . ($context["users_id"] ?? null))] ?? null) : null)))) ? ((($__internal_compile_23 = ($context["user_cache"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23[("_" . ($context["users_id"] ?? null))] ?? null) : null)) : ($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItem("User", ($context["users_id"] ?? null))))) : (null));
            // line 104
            yield "      ";
            // line 105
            yield "      ";
            $context["user_cache"] = Twig\Extension\CoreExtension::merge(($context["user_cache"] ?? null), [("_" . ($context["users_id"] ?? null)) => ($context["entry_user"] ?? null)]);
            // line 106
            yield "
      ";
            // line 107
            $context["anchor"] = (((($__internal_compile_24 = $context["entry"]) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["type"] ?? null) : null) . "_") . (($__internal_compile_25 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["id"] ?? null) : null));
            // line 108
            yield "      <div id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["anchor"] ?? null), "html", null, true);
            yield "\" class=\"timeline-item mb-3 ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["itiltype"] ?? null), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["state_class"] ?? null), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_26 = $context["entry"]) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["class"] ?? null) : null), "html", null, true);
            yield " ";
            yield ((CoreExtension::inFilter("right", ($context["item_position"] ?? null))) ? ("ms-auto") : (""));
            yield "\"
            data-itemtype=\"";
            // line 109
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_27 = $context["entry"]) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["type"] ?? null) : null), "html", null, true);
            yield "\" data-items-id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_28 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["id"] ?? null) : null), "html", null, true);
            yield "\"
            ";
            // line 110
            if (CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "item_action", [], "array", true, true, false, 110)) {
                yield "data-item-action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_29 = $context["entry"]) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["item_action"] ?? null) : null), "html", null, true);
                yield "\"";
            }
            yield ">

         ";
            // line 112
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook(Twig\Extension\CoreExtension::constant("Glpi\\Plugin\\Hooks::PRE_SHOW_ITEM"), ["item" => ($context["entry_object"] ?? null), "options" => ["parent" => ($context["item"] ?? null), "rand" => ($context["entry_rand"] ?? null)]]), "html", null, true);
            yield "

         <div class=\"row\">
            <div class=\"col-auto todo-list-state ";
            // line 115
            yield ((CoreExtension::inFilter("left", ($context["item_position"] ?? null))) ? ("ms-auto ms-0 order-sm-last") : (""));
            yield "\">
               ";
            // line 116
            if (((($__internal_compile_30 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["state"] ?? null) : null) === constant("Planning::TODO"))) {
                // line 117
                yield "                  ";
                if (($context["can_edit_i"] ?? null)) {
                    // line 118
                    yield "                     <span class=\"state state_1\" onclick=\"change_task_state(";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_31 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["id"] ?? null) : null), "html", null, true);
                    yield ", this)\" title=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("To do"), "html", null, true);
                    yield "\"></span>
                  ";
                } else {
                    // line 120
                    yield "                     <span class=\"state state_1\" title=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("To do"), "html", null, true);
                    yield "\" style=\"cursor: not-allowed;\"></span>
                  ";
                }
                // line 122
                yield "               ";
            } elseif (((($__internal_compile_32 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["state"] ?? null) : null) === constant("Planning::DONE"))) {
                // line 123
                yield "                  ";
                if (($context["can_edit_i"] ?? null)) {
                    // line 124
                    yield "                     <span class=\"state state_2\" onclick=\"change_task_state(";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_33 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["id"] ?? null) : null), "html", null, true);
                    yield ", this)\" title=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Done"), "html", null, true);
                    yield "\"></span>
                  ";
                } else {
                    // line 126
                    yield "                     <span class=\"state state_2\" title=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Done"), "html", null, true);
                    yield "\" style=\"cursor: not-allowed;\"></span>
                  ";
                }
                // line 128
                yield "               ";
            }
            // line 129
            yield "            </div>

            <div class=\"col-auto d-flex flex-column user-part ";
            // line 131
            yield ((CoreExtension::inFilter("right", ($context["item_position"] ?? null))) ? ("ms-auto ms-0 order-sm-last") : ("order-first"));
            yield "\">
               ";
            // line 132
            $context["avatar_rand"] = Twig\Extension\CoreExtension::random($this->env->getCharset());
            // line 133
            yield "               ";
            // line 134
            yield "               ";
            if ( !(null === ($context["entry_user"] ?? null))) {
                // line 135
                yield "                  ";
                $context["user_fields"] = Twig\Extension\CoreExtension::merge(CoreExtension::getAttribute($this->env, $this->source, ($context["entry_user"] ?? null), "fields", [], "any", false, false, false, 135), ["user_name" => $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(CoreExtension::getAttribute($this->env, $this->source,                 // line 136
($context["entry_user"] ?? null), "getFriendlyName", [], "method", false, false, false, 136)), "email" => CoreExtension::getAttribute($this->env, $this->source,                 // line 137
($context["entry_user"] ?? null), "getDefaultEmail", [], "method", false, false, false, 137)]);
                // line 139
                yield "                  <span id=\"timeline-avatar";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["avatar_rand"] ?? null), "html", null, true);
                yield "\">
                     ";
                // line 140
                yield Twig\Extension\CoreExtension::include($this->env, $context, "components/user/picture.html.twig", ["users_id" =>                 // line 141
($context["users_id"] ?? null), "user_object" =>                 // line 142
($context["entry_user"] ?? null), "enable_anonymization" =>                 // line 143
($context["anonym_user"] ?? null)], false);
                // line 144
                yield "
                  </span>
                  ";
                // line 146
                if (( !($context["anonym_user"] ?? null) && CoreExtension::getAttribute($this->env, $this->source, ($context["entry_user"] ?? null), "canView", [], "method", false, false, false, 146))) {
                    // line 147
                    yield "                     ";
                    $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showToolTip", [Twig\Extension\CoreExtension::include($this->env, $context, "components/user/info_card.html.twig", ["user" =>                     // line 149
($context["user_fields"] ?? null), "user_object" =>                     // line 150
($context["entry_user"] ?? null), "enable_anonymization" => false], false), ["applyto" => ("timeline-avatar" .                     // line 153
($context["avatar_rand"] ?? null))]]);
                    // line 155
                    yield "                  ";
                }
                // line 156
                yield "               ";
            } else {
                // line 157
                yield "                  <span id=\"timeline-avatar";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["avatar_rand"] ?? null), "html", null, true);
                yield "\"><span class=\"avatar avatar-md rounded\"></span></span>
               ";
            }
            // line 159
            yield "            </div>
            <div class=\"col-12 col-sm d-flex flex-column content-part\">
               <div class=\"mt-2 timeline-content ";
            // line 161
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["solution_class"] ?? null), "html", null, true);
            yield " flex-grow-1 ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["item_position"] ?? null), "html", null, true);
            yield " card\">
                  <div class=\"card-body px-1 px-xxl-3\">
                     ";
            // line 163
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/timeline_item_header.html.twig", ["user_object" =>             // line 164
($context["entry_user"] ?? null)]);
            // line 165
            yield "

                     ";
            // line 167
            if (CoreExtension::inFilter(($context["itiltype"] ?? null), Twig\Extension\CoreExtension::column(($context["timeline_itemtypes"] ?? null), "type"))) {
                // line 168
                yield "                        ";
                $context["matching_types"] = Twig\Extension\CoreExtension::filter($this->env, ($context["timeline_itemtypes"] ?? null), function ($__v__) use ($context, $macros) { $context["v"] = $__v__; return (0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["v"] ?? null), "type", [], "any", false, false, false, 168), ($context["itiltype"] ?? null))); });
                // line 169
                yield "                        ";
                if ((1 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["matching_types"] ?? null)), 0))) {
                    // line 170
                    yield "                           ";
                    $context["timeline_itemtype"] = Twig\Extension\CoreExtension::first($this->env->getCharset(), ($context["matching_types"] ?? null));
                    // line 171
                    yield "                           ";
                    if (CoreExtension::getAttribute($this->env, $this->source, ($context["timeline_itemtype"] ?? null), "template", [], "any", true, true, false, 171)) {
                        // line 172
                        yield "                              ";
                        yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, ($context["timeline_itemtype"] ?? null), "template", [], "any", false, false, false, 172), ["form_mode" => "view", "subitem" => CoreExtension::getAttribute($this->env, $this->source, ($context["timeline_itemtype"] ?? null), "item", [], "any", false, false, false, 172)]);
                        yield "
                           ";
                    }
                    // line 174
                    yield "                        ";
                }
                // line 175
                yield "                     ";
            } else {
                // line 176
                yield "                        <div class=\"read-only-content\">
                           ";
                // line 177
                yield $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getSafeHtml((($__internal_compile_34 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["content"] ?? null) : null));
                yield "
                        </div>
                     ";
            }
            // line 180
            yield "                     <div class=\"edit-content collapse\">
                        <div class=\"ajax-content\"></div>
                     </div>
                  </div>
               </div>

               ";
            // line 186
            if (CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "documents", [], "array", true, true, false, 186)) {
                // line 187
                yield "                  ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/sub_documents.html.twig", ["item" =>                 // line 188
($context["item"] ?? null), "entry" =>                 // line 189
$context["entry"]]);
                // line 190
                yield "
               ";
            }
            // line 192
            yield "            </div>
         </div>

         ";
            // line 195
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook(Twig\Extension\CoreExtension::constant("Glpi\\Plugin\\Hooks::POST_SHOW_ITEM"), ["item" => ($context["entry_object"] ?? null), "options" => ["parent" => ($context["item"] ?? null), "rand" => ($context["entry_rand"] ?? null)]]), "html", null, true);
            yield "
      </div>
   ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entry'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 198
        yield "
    ";
        // line 199
        if (($context["is_timeline_reversed"] ?? null)) {
            // line 200
            yield "        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/main_description.html.twig");
            yield "
    ";
        }
        // line 202
        yield "
    <div class=\"timeline-item tasks-title d-none\">
        <h3>";
        // line 204
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Task", "Tasks", Session::getPluralNumber()), "html", null, true);
        yield "</h3>
    </div>

    ";
        // line 207
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/todo-list-summary.html.twig");
        yield "

    <div class=\"timeline-item validations-title d-none mt-4\">
        <h3>";
        // line 210
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Validation", "Validations", Session::getPluralNumber()), "html", null, true);
        yield "</h3>
    </div>

    ";
        // line 213
        if ( !($context["is_timeline_reversed"] ?? null)) {
            // line 214
            yield "        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/approbation_form.html.twig");
            yield "
        ";
            // line 215
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/answer.html.twig");
            yield "
    ";
        }
        // line 217
        yield "
</div>

<script type=\"text/javascript\">
\$(function() {
   \$(document).on(\"click\", \".edit-timeline-item\", function() {
      var timeline_item = \$(this).closest(\".timeline-item\");
      var content_block = timeline_item.find(\".timeline-content\");
      var itemtype      = timeline_item.data('itemtype');
      var items_id      = timeline_item.data('items-id');
      var item_action   = timeline_item.data('item-action');

      content_block.find(\".read-only-content\").hide();
      content_block.find(\".edit-content\").show()
         .find(\".ajax-content\")
         .html('<i class=\"fas fa-3x fa-spinner fa-spin ms-auto\"></i>')
         .load(\"";
        // line 233
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/timeline.php"), "html", null, true);
        yield "\", {
            'action'     : 'viewsubitem',
            'type'       : itemtype,
            'parenttype' : '";
        // line 236
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 236), "html", null, true);
        yield "',
            '";
        // line 237
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getForeignKeyField", [], "method", false, false, false, 237), "html", null, true);
        yield "': ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_35 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 237)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["id"] ?? null) : null), "html", null, true);
        yield ",
            'id'         : items_id,
            'item_action': item_action
         });

      timeline_item.find('.timeline-item-buttons').addClass('d-none');
      timeline_item.find('.close-edit-content').removeClass('d-none');

      \$(\"#itil-footer\").find(\".main-actions\").hide();
      \$(\"#right-actions\").hide();
   });

   \$(document).on(\"click\", \".close-edit-content\", function() {
      var timeline_item = \$(this).closest(\".timeline-item\");
      timeline_item.find('.timeline-item-buttons').removeClass('d-none');
      timeline_item.find('.close-edit-content').addClass('d-none');

      timeline_item.find('.ajax-content').html('');
      timeline_item.find('.read-only-content').show();

      \$(\"#itil-footer .main-actions\").show();
      \$(\"#right-actions\").show();
   });
});
</script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/timeline/timeline.html.twig";
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
        return array (  560 => 237,  556 => 236,  550 => 233,  532 => 217,  527 => 215,  522 => 214,  520 => 213,  514 => 210,  508 => 207,  502 => 204,  498 => 202,  492 => 200,  490 => 199,  487 => 198,  470 => 195,  465 => 192,  461 => 190,  459 => 189,  458 => 188,  456 => 187,  454 => 186,  446 => 180,  440 => 177,  437 => 176,  434 => 175,  431 => 174,  425 => 172,  422 => 171,  419 => 170,  416 => 169,  413 => 168,  411 => 167,  407 => 165,  405 => 164,  404 => 163,  397 => 161,  393 => 159,  387 => 157,  384 => 156,  381 => 155,  379 => 153,  378 => 150,  377 => 149,  375 => 147,  373 => 146,  369 => 144,  367 => 143,  366 => 142,  365 => 141,  364 => 140,  359 => 139,  357 => 137,  356 => 136,  354 => 135,  351 => 134,  349 => 133,  347 => 132,  343 => 131,  339 => 129,  336 => 128,  330 => 126,  322 => 124,  319 => 123,  316 => 122,  310 => 120,  302 => 118,  299 => 117,  297 => 116,  293 => 115,  287 => 112,  278 => 110,  272 => 109,  259 => 108,  257 => 107,  254 => 106,  251 => 105,  249 => 104,  246 => 103,  244 => 102,  241 => 100,  238 => 99,  235 => 98,  232 => 97,  229 => 96,  226 => 95,  223 => 94,  220 => 93,  217 => 92,  214 => 91,  211 => 90,  208 => 89,  205 => 88,  203 => 87,  200 => 86,  197 => 85,  194 => 84,  191 => 83,  188 => 82,  185 => 81,  182 => 80,  179 => 79,  176 => 78,  173 => 77,  171 => 76,  168 => 75,  166 => 74,  163 => 73,  160 => 72,  157 => 71,  154 => 70,  151 => 69,  148 => 68,  145 => 67,  142 => 66,  139 => 65,  136 => 64,  133 => 63,  131 => 62,  128 => 61,  126 => 60,  123 => 59,  120 => 58,  117 => 57,  114 => 56,  111 => 55,  108 => 54,  105 => 53,  102 => 52,  99 => 51,  96 => 50,  79 => 49,  76 => 48,  73 => 47,  70 => 45,  68 => 44,  65 => 43,  60 => 41,  55 => 40,  49 => 38,  47 => 37,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/timeline.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\timeline.html.twig");
    }
}
