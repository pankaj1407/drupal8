<?php

/* modules/custom/event_module/templates/events-types-block.html.twig */
class __TwigTemplate_d3c30677a0ead24ec9531ed3b8678a03347faf9f867920336d5bb0d45f158dc2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("if" => 22, "for" => 23);
        $filters = array("t" => 34);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('if', 'for'),
                array('t'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 20
        echo "<article class=\"event_module_block\">
<h2 class=\"block-title\">";
        // line 21
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["title"] ?? null), "html", null, true));
        echo "</h2>
";
        // line 22
        if (($context["events_types"] ?? null)) {
            // line 23
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["events_types"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["event_type"]) {
                // line 24
                echo "        <div class=\"events-type-link\">
            ";
                // line 25
                if ((($context["current_tid"] ?? null) == $this->getAttribute($context["event_type"], "tid", array()))) {
                    // line 26
                    echo "                ";
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["event_type"], "name", array()), "html", null, true));
                    echo "
            ";
                } else {
                    // line 28
                    echo "                <a href=\"/view-events/";
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["event_type"], "tid", array()), "html", null, true));
                    echo "\">";
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["event_type"], "name", array()), "html", null, true));
                    echo "</a>
            ";
                }
                // line 29
                echo "    
            (";
                // line 30
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["event_type"], "events_count", array()), "html", null, true));
                echo ")
        </div>      
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event_type'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 34
            echo "    <h3>";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("No any events found.")));
            echo "</h3> 
";
        }
        // line 36
        echo "</article>

";
    }

    public function getTemplateName()
    {
        return "modules/custom/event_module/templates/events-types-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 36,  89 => 34,  79 => 30,  76 => 29,  68 => 28,  62 => 26,  60 => 25,  57 => 24,  52 => 23,  50 => 22,  46 => 21,  43 => 20,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "modules/custom/event_module/templates/events-types-block.html.twig", "D:\\project\\drupal\\modules\\custom\\event_module\\templates\\events-types-block.html.twig");
    }
}
