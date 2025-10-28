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

/* components/itilobject/linked_tickets.html.twig */
class __TwigTemplate_a54ae8bd27aa5a77e0f5e085a36065c98440f6776101aeb553f6ac330644ca6a extends Template
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
<input type=\"hidden\" name=\"_link[tickets_id_1]\" value=\"";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 34)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), "html", null, true);
        yield "\" />

";
        // line 36
        $context["linked_tickets"] = ((array_key_exists("linked_tickets", $context)) ? (Twig\Extension\CoreExtension::default(($context["linked_tickets"] ?? null), CoreExtension::getAttribute($this->env, $this->source, ($context["ticket_ticket"] ?? null), "getLinkedTicketsTo", [(($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 36)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["id"] ?? null) : null), true], "method", false, false, false, 36))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["ticket_ticket"] ?? null), "getLinkedTicketsTo", [(($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 36)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["id"] ?? null) : null), true], "method", false, false, false, 36)));
        // line 37
        if (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["linked_tickets"] ?? null))) {
            // line 38
            yield "<div class=\"card\">
   <div class=\"list-group list-group-flush list-group-hoverable\">
      ";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["linked_tickets"] ?? null));
            foreach ($context['_seq'] as $context["id"] => $context["linked"]) {
                // line 41
                yield "      ";
                $context["new_ticket"] = $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItem("Ticket", (($__internal_compile_3 = $context["linked"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["tickets_id"] ?? null) : null));
                // line 42
                yield "      <div class=\"list-group-item\">
         <div class=\"row\">
            <div class=\"col-auto\">
               ";
                // line 45
                yield $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Ticket_Ticket::getLinkName", [(($__internal_compile_4 =                 // line 46
$context["linked"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["link"] ?? null) : null), CoreExtension::getAttribute($this->env, $this->source,                 // line 47
$context["linked"], "tickets_id_1", [], "array", true, true, false, 47), true]);
                // line 49
                yield "
            </div>
            <div class=\"col text-truncate\">
               <a href=\"";
                // line 52
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath("Ticket", (($__internal_compile_5 = $context["linked"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["tickets_id"] ?? null) : null)), "html", null, true);
                yield "\" class=\"col-9 overflow-hidden text-nowrap\">
                  ";
                // line 53
                yield CoreExtension::getAttribute($this->env, $this->source, ($context["new_ticket"] ?? null), "getStatusIcon", [(($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source, ($context["new_ticket"] ?? null), "fields", [], "any", false, false, false, 53)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["status"] ?? null) : null)], "method", false, false, false, 53);
                yield "
                  <span title=\"";
                // line 54
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source, ($context["new_ticket"] ?? null), "fields", [], "any", false, false, false, 54)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["name"] ?? null) : null)), "html", null, true);
                yield "\" data-bs-toggle=\"tooltip\">
                     ";
                // line 55
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source, ($context["new_ticket"] ?? null), "fields", [], "any", false, false, false, 55)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["name"] ?? null) : null)), "html", null, true);
                yield "
                  </span>
                  (";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_9 = CoreExtension::getAttribute($this->env, $this->source, ($context["new_ticket"] ?? null), "fields", [], "any", false, false, false, 57)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["id"] ?? null) : null), "html", null, true);
                yield ")
               </a>
            </div>

            ";
                // line 61
                if (($context["canupdate"] ?? null)) {
                    // line 62
                    yield "               <div class=\"col-auto\">
                  <button type=\"submit\"
                          form=\"linked_tickets_";
                    // line 64
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["main_rand"] ?? null), "html", null, true);
                    yield "\"
                          name=\"id\"
                          value=\"";
                    // line 66
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["id"], "html", null, true);
                    yield "\"
                          class=\"btn btn-sm btn-ghost-danger\"
                          title=\"";
                    // line 68
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Delete permanently"), "html", null, true);
                    yield "\"
                          data-bs-toggle=\"tooltip\">
                     <i class=\"fas fa-unlink\"></i>
                  </button>
               </div>
            ";
                }
                // line 74
                yield "         </div>
      </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['id'], $context['linked'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 77
            yield "   </div>
</div>
";
        }
        // line 80
        yield "
";
        // line 81
        if ((($context["canupdate"] ?? null) &&  !(($__internal_compile_10 = ($context["params"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["template_preview"] ?? null) : null))) {
            // line 82
            yield "   ";
            $context["has_pending_link"] = (1 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), (($__internal_compile_11 = (($__internal_compile_12 = ($context["params"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["_link"] ?? null) : null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["tickets_id_2"] ?? null) : null)), 0));
            // line 83
            yield "   <div class=\"mt-2\">
      <button class=\"btn btn-sm btn-ghost-secondary ";
            // line 84
            yield ((($context["has_pending_link"] ?? null)) ? ("d-none") : (""));
            yield "\" type=\"button\"
               data-bs-toggle=\"collapse\" data-bs-target=\"#link_ticket_dropdowns\"
               aria-expanded=\"false\" aria-controls=\"link_ticket_dropdowns\" onclick=\"\$(this).hide();\">
         <i class=\"fas fa-plus\"></i>
         <span>";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Add"), "html", null, true);
            yield "</span>
      </button>

      <span class=\"collapse ";
            // line 91
            yield ((($context["has_pending_link"] ?? null)) ? ("show") : (""));
            yield "\" id=\"link_ticket_dropdowns\">
         ";
            // line 92
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["ticket_ticket"] ?? null), "dropdownLinks", ["_link[link]", (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 94
($context["params"] ?? null), "_link", [], "array", false, true, false, 94), "link", [], "array", true, true, false, 94) &&  !(null === (($__internal_compile_13 = CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "_link", [], "array", false, true, false, 94)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["link"] ?? null) : null)))) ? ((($__internal_compile_14 = CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "_link", [], "array", false, true, false, 94)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["link"] ?? null) : null)) : (""))], "method", false, false, false, 92), "html", null, true);
            // line 95
            yield "

         ";
            // line 97
            yield CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "dropdown", [["name" => "_link[tickets_id_2]", "used" => [(($__internal_compile_15 = CoreExtension::getAttribute($this->env, $this->source,             // line 99
($context["item"] ?? null), "fields", [], "any", false, false, false, 99)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["id"] ?? null) : null)], "displaywith" => ["id"], "display" => false, "value" => (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 102
($context["params"] ?? null), "_link", [], "array", false, true, false, 102), "tickets_id_2", [], "array", true, true, false, 102) &&  !(null === (($__internal_compile_16 = CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "_link", [], "array", false, true, false, 102)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["tickets_id_2"] ?? null) : null)))) ? ((($__internal_compile_17 = CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "_link", [], "array", false, true, false, 102)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["tickets_id_2"] ?? null) : null)) : (""))]], "method", false, false, false, 97);
            // line 103
            yield "
      </span>
   </div>
";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/linked_tickets.html.twig";
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
        return array (  176 => 103,  174 => 102,  173 => 99,  172 => 97,  168 => 95,  166 => 94,  165 => 92,  161 => 91,  155 => 88,  148 => 84,  145 => 83,  142 => 82,  140 => 81,  137 => 80,  132 => 77,  124 => 74,  115 => 68,  110 => 66,  105 => 64,  101 => 62,  99 => 61,  92 => 57,  87 => 55,  83 => 54,  79 => 53,  75 => 52,  70 => 49,  68 => 47,  67 => 46,  66 => 45,  61 => 42,  58 => 41,  54 => 40,  50 => 38,  48 => 37,  46 => 36,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/linked_tickets.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\linked_tickets.html.twig");
    }
}
