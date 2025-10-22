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

/* components/kanban/item_panels/default_panel.html.twig */
class __TwigTemplate_549091d7f3b26d101e65c587338c9de16ff1b60740c60a042b1072278bb0fed0 extends Template
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
        $macros["_self"] = $this->macros["_self"] = $this;
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        yield "
<div class=\"item-details-panel\" data-itemtype=\"";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["itemtype"] ?? null), "html", null, true);
        yield "\" data-items_id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "id", [], "any", false, false, false, 34), "html", null, true);
        yield "\">
   <div class=\"card d-flex flex-column h-100\">
      <div class=\"card-header d-block\">
         <h5 class=\"card-title\">
            <a href=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath(($context["itemtype"] ?? null), CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "id", [], "any", false, false, false, 38)), "html", null, true);
        yield "\">
               <i class=\"";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeIcon(($context["itemtype"] ?? null)), "html", null, true);
        yield "\" title=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName(($context["itemtype"] ?? null)), "html", null, true);
        yield "\"></i>
               ";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "name", [], "any", false, false, false, 40)), "html", null, true);
        yield "
            </a>
            <button type=\"button\" class=\"btn-link\" onclick=\"\$(this).closest('.item-details-panel').remove()\"><i class=\"ti ti-x\"></i></button>
         </h5>
         <h6 class=\"card-subtitle\">
            ";
        // line 45
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "is_milestone", [], "any", false, false, false, 45)) {
            // line 46
            yield "               <i class=\"fas fa-map-signs me-2\"></i>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Milestone"), "html", null, true);
            yield "
            ";
        }
        // line 48
        yield "         </h6>
      </div>
      <div class=\"card-body overflow-auto\">
         ";
        // line 61
        yield "         ";
        yield CoreExtension::callMacro($macros["_self"], "macro_print_hook_section", ["pre_kanban_panel_content", ($context["itemtype"] ?? null), CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "id", [], "any", false, false, false, 61)], 61, $context, $this->getSourceContext());
        yield "
         ";
        // line 62
        yield CoreExtension::callMacro($macros["_self"], "macro_print_hook_section", ["pre_kanban_panel_main_content", ($context["itemtype"] ?? null), CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "id", [], "any", false, false, false, 62)], 62, $context, $this->getSourceContext());
        yield "

         ";
        // line 64
        $context["content"] = $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getSafeHtml(CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "content", [], "any", false, false, false, 64));
        // line 65
        yield "         ";
        $context["preview"] = (((1 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["content"] ?? null)), 1000))) ? ((Twig\Extension\CoreExtension::slice($this->env->getCharset(), ($context["content"] ?? null), 0, 1000) . " (...)")) : (($context["content"] ?? null)));
        // line 66
        yield "         <div class=\"col-12 mb-3 rich_text_container\">";
        yield $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getSafeHtml(($context["preview"] ?? null));
        yield "</div>

         ";
        // line 68
        yield CoreExtension::callMacro($macros["_self"], "macro_print_hook_section", ["post_kanban_panel_main_content", ($context["itemtype"] ?? null), CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "id", [], "any", false, false, false, 68)], 68, $context, $this->getSourceContext());
        yield "

         <h5 class=\"d-flex justify-content-between\">
            <span>";
        // line 71
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Team"), "html", null, true);
        yield "</span>
            <button type=\"button\" class=\"btn-link kanban-item-edit-team\"><i class=\"fas fa-plus\"></i></button>
         </h5>
         ";
        // line 74
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["team"] ?? null))) {
            // line 75
            yield "            ";
            $context["item"] = $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeClass(($context["itemtype"] ?? null));
            // line 76
            yield "            ";
            if ($this->extensions['Glpi\Application\View\Extension\PhpExtension']->isUsingTrait(($context["item"] ?? null), "Glpi\\Features\\Teamwork")) {
                // line 77
                yield "               ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getTeamRoles", [], "method", false, false, false, 77));
                foreach ($context['_seq'] as $context["_key"] => $context["team_role"]) {
                    // line 78
                    yield "                  ";
                    $context["role_members"] = Twig\Extension\CoreExtension::filter($this->env, ($context["team"] ?? null), function ($__m__) use ($context, $macros) { $context["m"] = $__m__; return (0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["m"] ?? null), "role", [], "any", false, false, false, 78), $context["team_role"])); });
                    // line 79
                    yield "                  ";
                    if ((1 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["role_members"] ?? null)), 0))) {
                        // line 80
                        yield "                     <h5>";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getTeamRoleName", [$context["team_role"], Session::getPluralNumber()], "method", false, false, false, 80), "html", null, true);
                        yield "</h5>
                     <ul class=\"list-group team-list\" data-role=\"";
                        // line 81
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["team_role"], "html", null, true);
                        yield "\">
                        ";
                        // line 82
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable(($context["role_members"] ?? null));
                        foreach ($context['_seq'] as $context["_key"] => $context["team_member"]) {
                            // line 83
                            yield "                           <li class=\"list-group-item d-flex justify-content-between p-2\" data-itemtype=\"";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["team_member"], "itemtype", [], "any", false, false, false, 83), "html", null, true);
                            yield "\"
                               data-items_id=\"";
                            // line 84
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["team_member"], "items_id", [], "any", false, false, false, 84), "html", null, true);
                            yield "\"
                               data-name=\"";
                            // line 85
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(((CoreExtension::getAttribute($this->env, $this->source, $context["team_member"], "display_name", [], "any", true, true, false, 85)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["team_member"], "display_name", [], "any", false, false, false, 85), CoreExtension::getAttribute($this->env, $this->source, $context["team_member"], "name", [], "any", false, false, false, 85))) : (CoreExtension::getAttribute($this->env, $this->source, $context["team_member"], "name", [], "any", false, false, false, 85)))), "html", null, true);
                            yield "\"
                               data-firstname=\"";
                            // line 86
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(CoreExtension::getAttribute($this->env, $this->source, $context["team_member"], "firstname", [], "any", false, false, false, 86)), "html", null, true);
                            yield "\"
                               data-realname=\"";
                            // line 87
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(CoreExtension::getAttribute($this->env, $this->source, $context["team_member"], "realname", [], "any", false, false, false, 87)), "html", null, true);
                            yield "\">
                              ";
                            // line 89
                            yield "                           </li>
                        ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['team_member'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 91
                        yield "                     </ul>
                  ";
                    }
                    // line 93
                    yield "               ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['team_role'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 94
                yield "            ";
            }
            // line 95
            yield "         ";
        } else {
            // line 96
            yield "            ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("No team members"), "html", null, true);
            yield "
         ";
        }
        // line 98
        yield "         <hr>

         ";
        // line 100
        yield CoreExtension::callMacro($macros["_self"], "macro_print_hook_section", ["post_kanban_panel_content", ($context["itemtype"] ?? null), CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "id", [], "any", false, false, false, 100)], 100, $context, $this->getSourceContext());
        yield "
      </div>
      <div class=\"card-footer border-top flex-shrink-0 text-center p-3\">
         <a class=\"btn btn-outline w-100\" target=\"_blank\" rel=\"noopener\" href=\"";
        // line 103
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath(($context["itemtype"] ?? null), CoreExtension::getAttribute($this->env, $this->source, ($context["item_fields"] ?? null), "id", [], "any", false, false, false, 103)), "html", null, true);
        yield "\">
            <span class=\"pr-1\">";
        // line 104
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Open full form"), "html", null, true);
        yield "</span>
         </a>
      </div>
   </div>
</div>
";
        return; yield '';
    }

    // line 51
    public function macro_print_hook_section($__name__ = null, $__itemtype__ = null, $__items_id__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "itemtype" => $__itemtype__,
            "items_id" => $__items_id__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 52
            yield "            ";
            $context["content"] = $this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHookFunction(($context["name"] ?? null), ["itemtype" =>             // line 53
($context["itemtype"] ?? null), "items_id" =>             // line 54
($context["items_id"] ?? null)], true);
            // line 56
            yield "            ";
            if (( !Twig\Extension\CoreExtension::testEmpty(($context["content"] ?? null)) &&  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim((($__internal_compile_0 = ($context["content"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["content"] ?? null) : null))))) {
                // line 57
                yield "               ";
                yield (($__internal_compile_1 = ($context["content"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["content"] ?? null) : null);
                yield "
               <hr>
            ";
            }
            // line 60
            yield "         ";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/kanban/item_panels/default_panel.html.twig";
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
        return array (  251 => 60,  244 => 57,  241 => 56,  239 => 54,  238 => 53,  236 => 52,  222 => 51,  211 => 104,  207 => 103,  201 => 100,  197 => 98,  191 => 96,  188 => 95,  185 => 94,  179 => 93,  175 => 91,  168 => 89,  164 => 87,  160 => 86,  156 => 85,  152 => 84,  147 => 83,  143 => 82,  139 => 81,  134 => 80,  131 => 79,  128 => 78,  123 => 77,  120 => 76,  117 => 75,  115 => 74,  109 => 71,  103 => 68,  97 => 66,  94 => 65,  92 => 64,  87 => 62,  82 => 61,  77 => 48,  71 => 46,  69 => 45,  61 => 40,  55 => 39,  51 => 38,  42 => 34,  39 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/kanban/item_panels/default_panel.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\kanban\\item_panels\\default_panel.html.twig");
    }
}
