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

/* components/itilobject/timeline/timeline_item_header.html.twig */
class __TwigTemplate_85a95a144f7e81148f3cdb991db144c8b96cb32cb5c8685579fa37c529207069 extends Template
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
<div class=\"d-flex timeline-header\">
   <div class=\"d-flex creator\">
      ";
        // line 36
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/timeline_item_header_badges.html.twig", ["users_id" =>         // line 37
($context["users_id"] ?? null), "user_object" =>         // line 38
($context["user_object"] ?? null), "date_creation" =>         // line 39
($context["date_creation"] ?? null), "date_mod" =>         // line 40
($context["date_mod"] ?? null), "users_id_editor" => (($__internal_compile_0 =         // line 41
($context["entry_i"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["users_id_editor"] ?? null) : null), "anchor" => (((($__internal_compile_1 =         // line 42
($context["entry"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["type"] ?? null) : null) . "_") . (($__internal_compile_2 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["id"] ?? null) : null)), "anonym_user" =>         // line 43
($context["anonym_user"] ?? null)], false);
        // line 44
        yield "
   </div>

   <div class=\"d-flex ms-auto timeline-item-buttons\">
      ";
        // line 48
        $context["actions"] = [];
        // line 49
        yield "      ";
        if ((((($__internal_compile_3 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["can_edit"] ?? null) : null) &&  !($context["status_closed"] ?? null)) &&  !CoreExtension::inFilter((($__internal_compile_4 = ($context["entry"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["type"] ?? null) : null), ["Document_Item", "Assign"]))) {
            // line 50
            yield "         ";
            $context["edit_btn"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 51
                yield "            <li>
               <a class=\"dropdown-item edit-timeline-item\" href=\"#\">
                  <i class=\"fa-fw ti ti-edit\"></i>
                  <span>";
                // line 54
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Edit"), "html", null, true);
                yield "</span>
               </a>
            </li>
         ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 58
            yield "         ";
            $context["actions"] = Twig\Extension\CoreExtension::merge(($context["actions"] ?? null), ["edit_btn" => ($context["edit_btn"] ?? null)]);
            // line 59
            yield "      ";
        }
        // line 60
        yield "
      ";
        // line 61
        if (($context["is_private"] ?? null)) {
            // line 62
            yield "         <span class=\"is-private ms-2\" title=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Private"), "html", null, true);
            yield "\"
               data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\">
            <i class=\"ti ti-lock\" aria-label=\"";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Private"), "html", null, true);
            yield "\"></i>
         </span>
      ";
        }
        // line 67
        yield "
      ";
        // line 68
        if ((($__internal_compile_5 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["can_promote"] ?? null) : null)) {
            // line 69
            yield "         ";
            if ((1 === CoreExtension::compare((($__internal_compile_6 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["sourceof_items_id"] ?? null) : null), 0))) {
                // line 70
                yield "            ";
                $context["promoted_btn"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 71
                    yield "               <li>
                  <a class=\"dropdown-item text-warning\" href=\"";
                    // line 72
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath("Ticket", (($__internal_compile_7 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["sourceof_items_id"] ?? null) : null)), "html", null, true);
                    yield "\">
                     <i class=\"fa-fw ti ti-git-branch\"></i>
                     <span>";
                    // line 74
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::sprintf(__("%s was already promoted"), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName((($__internal_compile_8 = ($context["entry"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["type"] ?? null) : null))), "html", null, true);
                    yield "</span>
                  </a>
               </li>
            ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 78
                yield "            ";
                $context["actions"] = Twig\Extension\CoreExtension::merge(($context["actions"] ?? null), ["promoted_btn" => ($context["promoted_btn"] ?? null)]);
                // line 79
                yield "         ";
            } else {
                // line 80
                yield "            ";
                $context["promote_url"] = ("?_promoted_fup_id=" . (($__internal_compile_9 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["id"] ?? null) : null));
                // line 81
                yield "            ";
                if (((($__internal_compile_10 = ($context["entry"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["type"] ?? null) : null) === "TicketTask")) {
                    // line 82
                    yield "               ";
                    $context["promote_url"] = ("?_promoted_task_id=" . (($__internal_compile_11 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["id"] ?? null) : null));
                    // line 83
                    yield "            ";
                }
                // line 84
                yield "
            ";
                // line 85
                $context["promote_btn"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 86
                    yield "               <li>
                  <a class=\"dropdown-item\" href=\"";
                    // line 87
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath("Ticket") . ($context["promote_url"] ?? null)), "html", null, true);
                    yield "\">
                     <i class=\"fa-fw ti ti-git-branch\"></i>
                     <span>";
                    // line 89
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Promote to Ticket"), "html", null, true);
                    yield "</span>
                  </a>
               </li>
            ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 93
                yield "            ";
                $context["actions"] = Twig\Extension\CoreExtension::merge(($context["actions"] ?? null), ["promote_btn" => ($context["promote_btn"] ?? null)]);
                // line 94
                yield "         ";
            }
            // line 95
            yield "      ";
        }
        // line 96
        yield "
      ";
        // line 97
        if (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["actions"] ?? null))) {
            // line 98
            yield "         <div class=\"dropdown ms-2\">
            <button class=\"btn btn-sm btn-ghost-secondary timeline-more-actions\" type=\"button\" id=\"more-actions-";
            // line 99
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["entry_rand"] ?? null), "html", null, true);
            yield "\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
               <i class=\"ti ti-dots-vertical\"></i>
            </button>
            <ul class=\"dropdown-menu\" aria-labelledby=\"more-actions-";
            // line 102
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["entry_rand"] ?? null), "html", null, true);
            yield "\">
               ";
            // line 103
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["actions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
                // line 104
                yield "                  ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["action"], "html", null, true);
                yield "
               ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['action'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 106
            yield "            </ul>
         </div>
      ";
        }
        // line 109
        yield "   </div>

   <button class=\"btn btn-sm btn-ghost-secondary close-edit-content d-none ms-auto\">
      <i class=\"ti ti-x\"></i>
   </button>
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/timeline/timeline_item_header.html.twig";
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
        return array (  213 => 109,  208 => 106,  199 => 104,  195 => 103,  191 => 102,  185 => 99,  182 => 98,  180 => 97,  177 => 96,  174 => 95,  171 => 94,  168 => 93,  160 => 89,  155 => 87,  152 => 86,  150 => 85,  147 => 84,  144 => 83,  141 => 82,  138 => 81,  135 => 80,  132 => 79,  129 => 78,  121 => 74,  116 => 72,  113 => 71,  110 => 70,  107 => 69,  105 => 68,  102 => 67,  96 => 64,  90 => 62,  88 => 61,  85 => 60,  82 => 59,  79 => 58,  71 => 54,  66 => 51,  63 => 50,  60 => 49,  58 => 48,  52 => 44,  50 => 43,  49 => 42,  48 => 41,  47 => 40,  46 => 39,  45 => 38,  44 => 37,  43 => 36,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/timeline_item_header.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\timeline_item_header.html.twig");
    }
}
