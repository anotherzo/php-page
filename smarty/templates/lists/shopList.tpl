<tr class="hline_shop">
    <td>
        <table class="fixedHeader">
            <tr>
	            <th class="amount">Anzahl<br />Amount</th>
	            {if $region == "ch"}
	            <th class="money">CHF<br/>CHF</th>
	            {else}
	            <th class="money">Euro<br/>Euro</th>
	            {/if}
	            <th class="nr">Nr.<br/>No</th>
	            <th class="title">Titel<br/>Title</th>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>
        <div class="scrollContentDiv">
            <table class="scrollContent">
            {section name=id loop=$cats}
                <tr>
                    <td colspan="3"></td><td class="cattitle"><span class="german_b">{$cats[id]->title_de()} &mdash;</span> <span class="english_b">{$cats[id]->title_en()}</span></td>
                </tr>
                {section name=it loop=$prods[id]}
                <tr>
                    <td class="amount"><input type="text" name="amount[]" size="3"/><input type="hidden" name="prodnr[]" value="{$prods[id][it]->prod_nr()}"/></td>
                    {if $region == "ch"}
                    <td class="money">{$prods[id][it]->price_ch()|money_format}</td>
                    {else}
                    <td class="money">{$prods[id][it]->price_eu()|money_format}</td>
                    {/if}
                    <td class="nr">{$prods[id][it]->prod_nr()}</td>
                    <td class="title">
                        {if $prods[id][it]->title_de() != "0"}
                        {$prods[id][it]->composer()} {$prods[id][it]->title_de()}
                        {else}
                        {$prods[id][it]->title_cd()} - {$prods[id][it]->interprets()}
                        {/if}
                    </td>
                </tr>
                {/section}
                {if !($smarty.section.id.last)}
                <tr>
                    <td class="hline_shop" colspan="5"></td>
                </tr>
                {/if}
            {/section}
            </table>
        </div>
    </td>
</tr>
